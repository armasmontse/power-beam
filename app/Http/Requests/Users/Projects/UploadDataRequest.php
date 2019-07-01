<?php

namespace App\Http\Requests\Users\Projects;

use App\Http\Requests\Request;

class UploadDataRequest extends Request
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
    	$rules = [
    		'option' => 'required|in:file,input'
    	];

    	if ($this->option == 'file') {
    		$rules['data_input'] = 'required|exists:files,id';
    	}elseif ($this->option == 'input') {
    		$rules['data'] = 'array';
    		$rules['data.number_of_nets'] = 'required|integer|min:0';
    		$rules['data.number_BGA_components'] = 'required|integer|min:0';
    		$rules['data.number_impedance'] = 'required|integer|min:0';
    		$rules['data.number_BGA_balls'] = 'required|integer|min:0';
    	}

        return $rules;
    }
}
