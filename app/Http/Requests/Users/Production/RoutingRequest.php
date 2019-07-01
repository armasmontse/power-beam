<?php

namespace App\Http\Requests\Users\Production;

use App\Http\Requests\Request;

class RoutingRequest extends Request
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
			'data' => 'required|array',
			'data.trace' => 'required|array',
			'data.trace.number' => 'required|numeric|min:0',
			'data.trace.unity' => 'required|string',
			'data.trace_to_trace' => 'required|array',
			'data.trace_to_trace.number' => 'required|numeric|min:0',
			'data.trace_to_trace.unity' => 'required|string',
			'data.hole_size' => 'required|array',
			'data.hole_size.number' => 'required|numeric|min:0',
			'data.hole_size.unity' => 'required|string',
			'data.pad_size' => 'required|array',
			'data.pad_size.number' => 'required|numeric|min:0',
			'data.pad_size.unity' => 'required|string',
		];

		if ($this->option == 'file') {
			$rules['routing'] = 'required|exists:files,id';
		}elseif($this->option == 'input') {
			$rules['data.nets'] = 'required|numeric|min:0';
		}

		return $rules;
	}
}
