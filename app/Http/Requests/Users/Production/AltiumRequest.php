<?php

namespace App\Http\Requests\Users\Production;

use App\Http\Requests\Request;

class AltiumRequest extends Request
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
			"altium" => 'required|exists:files,id',
		];
	}
}
