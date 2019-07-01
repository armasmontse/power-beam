<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Projects\Project;
use App\Models\Projects\Quote;
use App\Models\Users\User;

use App\Notifications\RejectQuoteNotification;
use App\Notifications\AcceptQuoteNotification;
use App\Notifications\User\Projects\ProjectNotification;

use Exception;

use Carbon\Carbon;

class UserQuotesController extends Controller
{
    public function accept(User $user, Project $user_project, Quote $quote, Request $request)
    {
        try {
        	// Guardamos la info de la cotización
    		$quote->fill([
    			'decision' => true,
    			'decided_at' => Carbon::now(),
    		]);
            $quote->save();

            // Cambiamos el estatus del proyecto
            $user_project->next();

            // Notificamos al project manager que se aceptó la cotización.
            $user_project->manager->notify(new AcceptQuoteNotification($quote));

            // Notificamos el cambio al project manager
            $user_project->manager->notify(new ProjectNotification($user_project));

    	} catch (Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
    	}

        return redirect()->route('user::projects.show', [
    		'user' => $user,
    		'user_project' => $user_project
    	]);
    }

    public function reject(User $user, Project $user_project, Quote $quote, Request $request)
    {
    	try {
    		// Guradamos la decisión
    		$quote->fill([
    			'decision' => false,
    			'decided_at' => Carbon::now(),
    			'feedback' => $request->feedback
    		]);
            $quote->save();

            // Regresamos el proyecto al estatus anterior.
            $user_project->before();

            // Avisamos al project manager que rechazaron el quote.
            $user_project->manager->notify(new RejectQuoteNotification($quote));

            // Notificamos al manager que se cambio el estatus del proyecto.
            $user_project->manager->notify(new ProjectNotification($user_project));

    	} catch (Exception $e) {
    		return redirect()->back()->withErrors([$e->getMessage()]);
    	}

    	return redirect()->route('user::projects.show', [
    		'user' => $user,
    		'user_project' => $user_project
    	]);
    }
}
