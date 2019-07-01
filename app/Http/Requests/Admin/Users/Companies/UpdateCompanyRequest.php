<?php

namespace App\Http\Requests\Admin\Users\Companies;

use App\Http\Requests\Request;

class UpdateCompanyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('manage_companies') ) {
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
        $rules = [
            'name'     => 'required|string|max:255',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' =>  trans('manage_types.create.name.required'),
            'name.string' =>  trans('manage_types.create.name.string'),
            'name.max' =>  trans('manage_types.create.name.max'),
        ];
    }
}
