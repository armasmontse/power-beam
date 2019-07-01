<?php

namespace App\Http\Requests\Users\Production;

use App\Http\Requests\Request;

class StackupRequest extends Request
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
			'option' => 'required|in:file,input',
		];

		if ($this->option == 'file') {
			$rules['stackup'] = 'required|exists:files,id';
		}elseif($this->option == 'input') {
			$rules['data'] = 'required|array';
			$rules['data.thickness'] = 'required|array';
			$rules['data.thickness.number'] = 'required|string';
			$rules['data.thickness.unity'] = 'required|string';
			$rules['data.cuterlayer'] = 'required|string';
			$rules['data.innerlayer'] = 'required|array';
			$rules['data.innerlayer.first'] = 'required|string';
			$rules['data.innerlayer.second'] = 'required|string';
		}

		return $rules;
	}
}
