<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\Request;
use App\Models\Users\User;
use App\Models\Users\Role;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('manage_users') ) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_editable = $this->route()->parameters()["user_editable"];

        return [
            'email'         => 'required|email|max:255',
            'first_name'    => 'required|max:255|string',
            'last_name' 	=> 'required|max:255|string',
            'job_position'  => 'required|max:255|string',
            'company'  		=> 'required|exists:companies,id',
			'phone' 		=> 'required|max:255|string',
        ];

    }

    public function messages()
    {
        return [
            'email.required'    => trans('users.email.required'),
            'email.email'       => trans('users.email.email'),
            'email.max'         => trans('users.email.max'),

            'first_name.required'         => trans('users.name.required'),
            'first_name.max'              => trans('users.name.max'),

            'last_name.required'    => trans('users.last_name.required'),
            'last_name.max'         => trans('users.last_name.max'),

            'job_position.required'    => trans('users.job_position.required'),
            'job_position.max'         => trans('users.job_position.max'),

            'company.required'    => trans('users.company.required'),
            'company.exists'      => trans('users.company.exists'),

            'phone.required'    => trans('users.phone.required'),
            'phone.max'         => trans('users.phone.max'),
        ];
    }
}
