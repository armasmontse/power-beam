<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Projects\Project;
use App\Models\Projects\Quote;
use App\Models\Projects\PurchaseOrder;
use App\Models\Projects\Payment;
use App\Models\Users\User;
use App\Http\Requests\Users\PayRequest;
use App\Notifications\User\Projects\ProjectNotification;
use Exception;

use Stripe\Stripe;
use Stripe\Source;

use Carbon\Carbon;

class UserPaymentController extends Controller
{
    public function pay(User $user, Project $user_project, Quote $quote, PayRequest $request)
    {
    	if ($request->payment_method == 'stripe') {

    		return $this->payWithStripe($request, $user, $user_project, $quote);

    	}elseif ($request->payment_method == 'purchase_order') {

    		return $this->payWithPowerbeam($request, $user, $user_project, $quote);
    	}

    	return back()->withErrors(['No payment method was selected']);
    }

    protected function payWithStripe($request, $user, $project, $quote)
    {
    	try {

    		// Revisamos si el usuario está registrado en Stripe.
    		if (!$user->hasStripeId()) {
    			// Si no está registrado lo registramos.
    			$user->createAsStripeCustomer($request->token);
    			// Hacemos el cargo por el monto.
    			$charge = $user->charge($quote->amount);
    		}else {
    			// Revisamos si necesitamos crear una nueva tarjeta
    			$new_card = $request->new_card == 'true' ? true : false;

    			if ($new_card) {
    				// Agregamos la tarjeta al usuario.
    				$user->updateCard($request->token);
    				// Hacemos el cargo por el monto.
    				$charge = $user->charge($quote->amount);
    			}else {
    				// Hacemos el cargo a ese customer con ese ID.
    				$charge = $user->charge($quote->amount, [
    					'customer' => $user->asStripeCustomer()->id,
    					'source' => $request->card_id
    				]);
    			}
    		}

    	} catch (Exception $e) {
    		// Procesamos el error.
    		return $this->processErrorPayment($e->getMessage());
    	}

    	// Creamos el payment en la BD.
    	$payment = Payment::create([
    		'code' => uniqid(),
    		'quote_id' => $quote->id,
    		'amount' => $quote->amount,
    		'currency' => $user->preferredCurrency(),
    		'payment_status' => $charge->status,
    		'metadata' => [],
    		'payable_id' => $charge->id,
    		'payable_type' => 'stripe',
    	]);

    	if ($payment->payment_status != 'succeeded') {
    		// Si no es success procesamos el pago como erroneo.
    		return $this->processErrorPayment(trans('payment.stripe.error'));
    	}

    	// Procesamos el pago como exitoso.
    	return $this->processSuccessPayment($user, $project, $quote);
    }

    protected function payWithPowerbeam($request, $user, $project, $quote)
    {
        try {
            // Creamos el purchase order para ese archivo.
            $purchase_order = PurchaseOrder::create(['file_id' => $request->purchase_order]);
		} catch (Exception $e) {
            // Procesamos el error.
            return $this->processErrorPayment($e->getMessage());
		}

		// Creamos el payment en la BD.
		$payment = Payment::create([
			'code' => uniqid(),
			'quote_id' => $quote->id,
			'amount' => $quote->amount,
			'currency' => $user->preferredCurrency(),
			'payment_status' => 'succeeded',
			'metadata' => [],
			'payable_id' => $purchase_order->id,
			'payable_type' => 'purchase_order',
		]);

        // *Notification* project manager.
        $project->manager->notify(new ProjectNotification($project));
        // *Notification* admin.
        // ProjectNotification::AdminNotify(,$project);

        return $this->processSuccessPayment($user, $project, $quote);
    }

    protected function processSuccessPayment($user, $project, $quote)
    {
    	// Pasamos el proyecto al siguiente estatus.
    	$project->next();

    	// Redireccionamos a la página de recibo de pago.
    	return redirect()->route('user::projects.paymentReceipt', ['user' => $user, 'user_project' => $project])->withStatus('We receive your payment succesfully.');
    }

    protected function processErrorPayment($error)
    {
    	// Redireccionamos al shipping del checkout.
    	return redirect()->back()->withErrors([$error]);
    }

    public function paymentReceipt(User $user, Project $user_project, Request $request)
    {
    	$data = [
    		'project' => $user_project,
    		'quote' => $user_project->accepted_quote,
    		'payment' => $user_project->accepted_quote->payment,
    	];

    	return view('users.projects.payment', $data);
    }
}
