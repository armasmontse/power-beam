<?php

namespace App\Http\Requests\Users\Files;

use App\Http\Requests\Request;

class CreateFileRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
		$input = $this->all();

        $rules = [
        	'file' => 'required|file'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'data_input.required'      =>  trans('manage_projects.create.uploaddata.data_input.required'),
            'data_input.file'          =>  trans('manage_projects.create.uploaddata.data_input.file'),
            'data_input.mimes'         =>  trans('manage_projects.create.uploaddata.data_input.mimes'),
        ];
    }

}
