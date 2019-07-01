<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdateEmailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password" 	=> "required|password_check:".$this->user->password,
            "new_email" => "required|email|max:255|unique:users,email,".$this->user->id.",id|not_in:".$this->user->email
        ];
    }

    public function messages()
    {
        return [
            'password.required'         =>  trans('requests.password.required'),
            'password.password_check'   =>  trans('requests.password.password_check'),

            'new_email.required'            =>  trans('requests.email.required'),
            'new_email.email'               =>  trans('requests.email.email'),
            'new_email.max'                 =>  trans('requests.email.max'),
            'new_email.unique'              =>  trans('requests.email.unique'),
            'new_email.not_in'              =>  trans('requests.email.not_in'),
        ];
    }
}
