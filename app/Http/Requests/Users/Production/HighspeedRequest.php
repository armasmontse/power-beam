<?php

namespace App\Http\Requests\Users\Production;

use App\Http\Requests\Request;

class HighspeedRequest extends Request
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
			'data.has_cpu' => 'required|in:Yes,No',
			'data.interface_design' => 'required|in:Yes,No',
			'data.impedance_traces' => 'required|in:Yes,No',
		];

		if (array_key_exists('has_cpu', $this->data) && $this->data['has_cpu'] == 'Yes') {
			$rules = array_merge($rules, [
				'data.cpu_number' => 'required|numeric|min:0',
				'data.cpu_package' => 'required|string',
				'data.package_pitch' => 'required|numeric|min:0',
				'data.speenA1' => 'required|string'
			]);
		}

		if (array_key_exists('interface_design', $this->data) && $this->data['interface_design'] == 'Yes') {
			$rules = array_merge($rules, [
				'data.max_working_speed' => 'required|string',
			]);
		}

		if (array_key_exists('impedance_traces', $this->data) && $this->data['impedance_traces'] == 'Yes') {
			$rules = array_merge($rules, [
				'data.dielectric_material' => 'required|string',
				'data.dielectric_constant' => 'required|numeric|min:0',
			]);
		}

		return $rules;
	}
}
