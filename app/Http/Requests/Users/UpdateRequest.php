<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;
use App\Model\Users\User;

class UpdateRequest extends Request
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
            'name' 	        => 'required|max:255|string',
            'last_name' 	=> 'required|max:255|string',
            'job_place'     => 'required|max:255|string',
			'phone' 		=> 'required|max:255|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => trans('requests.name.required'),
            'name.max'              => trans('requests.name.max'),
            'last_name.required'    => trans('requests.last_name.required'),
            'last_name.max'         => trans('requests.last_name.max'),
            'job_place.required'    => trans('requests.job_place.required'),
            'job_place.max'         => trans('requests.job_place.max'),
            'phone.required'    	=> trans('requests.phone.required'),
            'phone.max'         	=> trans('requests.phone.max'),
        ];
    }
}
