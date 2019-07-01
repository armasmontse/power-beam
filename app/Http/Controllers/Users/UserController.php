<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\ClientController;

use App\Http\Requests\Users\UpdateRequest;
use App\Http\Requests\Users\UpdateEmailRequest;
use App\Http\Requests\Users\UpdatePasswordRequest;

use App\Notifications\User\UpdatePasswordNotification;
use App\Notifications\User\UpdateMailNotification;

use App\Models\Users\User;

use App\Models\Users\Card;
use App\Models\Users\BankAccount;

use Redirect;

use Response;

class UserController extends ClientController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    	$data = [
    		'user' => $user,
    	];

        return view('users.show', $data);
    }


    public function updateEmail(UpdateEmailRequest $request, User $user)
    {
        $input = $request->all();

        $clone = $user;

        $user->email = $input['new_email'];

        if (!$user->save()) {
            return Redirect::back()->withErrors([trans('users.update_email.error')]);
        }

        $clone->notify( new UpdateMailNotification);

        return Redirect::route('user::profile',$user->name)->with('status', trans('users.update_email.success'));
    }


    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $input = $request->all();

        $user->password = bcrypt( $input["password"] ) ;

        if (!$user->save()) {
            return Redirect::back()->withErrors([trans('users.update_password.error')]);
        }

        $user->notify( new UpdatePasswordNotification);

        return Redirect::route('user::profile',$user->name)->with('status', trans('users.update_password.success'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $input = $request->all();

		$user->first_name 		    = $input['name'];
        $user->last_name  		= $input['last_name'];
        $user->job_position  		= $input['job_place'];
        // $user->company_name  	= $input['company_name'];
        $user->phone      		= $input['phone'];

        if (!$user->save()) {
            return Redirect::back()->withErrors([trans('manage_users.update.error')]);
        }

        return Redirect::route('user::profile',$user->name)->with('status', trans('manage_users.update.success'));
    }

}
