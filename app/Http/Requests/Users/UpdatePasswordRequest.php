<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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
            "old_password" => "required|password_check:".$this->user->password,
            "password" => "required|confirmed|min:6",

        ];
    }

    public function messages()
    {
        return [
            'old_password.required'         =>  trans('requests.old_password.required'),
            'old_password.password_check'   =>  trans('requests.old_password.password_check'),
            'password.required'             =>  trans('requests.old_password.required'),
            'password.confirmed'            =>  trans('requests.old_password.confirmed'),
            'password.min'                  =>  trans('requests.old_password.min'),
        ];
    }
}
