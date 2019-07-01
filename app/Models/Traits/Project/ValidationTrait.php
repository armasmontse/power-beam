<?php 

namespace App\Models\Traits\Project;

trait ValidationTrait {

	protected function validate($rules, $stored_value = [])
	{
		if(!is_array($stored_value)){ return false; }

		$result = true;

		foreach ($rules as $keys_path => $rule) {

			$value = array_get($stored_value, $keys_path, '');

			if ($rule == 'array') {
				$result &= is_array($value);
			}
			if ($rule == 'required') {
				$result &= isset($value) && strlen($value);
			}
			if ($rule == 'file') {
				$result &= $this->hasFile($keys_path);
			}
		}

		return $result;
	}

	// Steps for the "production" status.

	public function validateStepGeometry()
	{
		$rules = [
			'dwg_' => 'file'
		];
		return $this->validate($rules);
	}

	public function validateStepStackup()
	{
    	if (is_null($this->production)) {
    		return false;
    	}

    	$rules = [
    		'option' => 'required'
    	];

		$option = array_get($this->production->stackup, 'option', '');

		if ($option == 'input') {
			$rules = array_merge($rules, [
				'data.thickness.number' => 'required',
				'data.thickness.unity' 	=> 'required',
				'data.cuterlayer' 		=> 'required',
				'data.innerlayer.first' => 'required',
				'data.innerlayer.second'=> 'required',
			]);
		}elseif ($option == 'file') {
			$rules = array_merge($rules, [
				'stackup' => 'file'
			]);
		}

		return $this->validate($rules, $this->production->stackup);
	}

	public function validateStepRouting()
	{
		if (is_null($this->production)) {
			return false;
		}

		$rules = [
			'option' 					=> 'required',
			'data' 						=> 'array',
			'data.trace' 				=> 'array',
			'data.trace.number' 		=> 'required',
			'data.trace.unity' 			=> 'required',
			'data.trace_to_trace' 		=> 'array',
			'data.trace_to_trace.number'=> 'required',
			'data.trace_to_trace.unity' => 'required',
			'data.hole_size' 			=> 'array',
			'data.hole_size.number' 	=> 'required',
			'data.hole_size.unity' 		=> 'required',
			'data.pad_size' 			=> 'array',
			'data.pad_size.number' 		=> 'required',
			'data.pad_size.unity' 		=> 'required'
		];

		$option = array_get($this->production->routing, 'option', '');

		if ($option == 'input') {
			$rules = array_merge($rules, [
				'data.nets' => 'required'
			]);
		}elseif ($option == 'file') {
			$rules = array_merge($rules, [
				'routing' => 'file'
			]);
		}

		return $this->validate($rules, $this->production->routing);
	}

	public function validateStepHighSpeed()
	{
		if (is_null($this->production)) {
			return false;
		}

		$rules = [
			'data.has_cpu' => 'required',
			'data.interface_design' => 'required',
			'data.impedance_traces' => 'required',
		];

		$has_cpu = array_get($this->production->highspeed, 'has_cpu', 'No');

		if ($has_cpu == 'Yes') {
			$rules = array_merge($rules, [
				'data.cpu_number' => 'required',
				'data.cpu_package' => 'required',
				'data.package_pitch' => 'required',
				'data.speenA1' => 'required',
			]);
		}

		$interface_design = array_get($this->production->highspeed, 'interface_design', 'No');

		if ($interface_design == 'Yes') {
			$rules = array_merge($rules, [
				'data.max_working_speed' => 'required',
			]);
		}

		$impedance_traces = array_get($this->production->highspeed, 'impedance_traces', 'No');

		if ($impedance_traces == 'Yes') {
			$rules = array_merge($rules, [
				'data.dielectric_material' => 'required',
				'data.dielectric_constant' => 'required',
			]);
		}

		return $this->validate($rules, $this->production->highspeed);
	}

	public function validateStepPowerSupply()
	{
		if (is_null($this->production)) {
			return false;
		}

		$rules = [
			'data.power_nets' => 'required',
			'data.ground_nets' => 'required',
		];

		return $this->validate($rules, $this->production->power_supply);
	}

	public function validateStepAltium()
	{
		if (is_null($this->production)) {
			return false;
		}

		$rules = [
			'data' => 'file',
		];

		return $this->validate($rules);
	}

	// End steps for the "production" status.

	// Steps for the "new" status.
	
	public function validateStepData()
    {
    	if (is_null($this->production)) {
    		return false;
    	}

    	$rules = [
    		'option' => 'required'
    	];

		$option = array_get($this->production->data, 'option', '');

		
		if ($option == 'input') {
			$rules = array_merge($rules, [
				'data.number_of_nets' => 'required',
				'data.number_BGA_components' => 'required',
				'data.number_impedance' => 'required',
				'data.number_BGA_balls' => 'required',
			]);
		}elseif ($option == 'file') {
			$rules = array_merge($rules, [
				'data' => 'file',
			]);
		}

		return $this->validate($rules, $this->production->data);
    }

    public function validateStepDwg()
    {
    	$rules = [
    		'dwg' => 'file'
    	];

    	return $this->validate($rules);
    }

    public function validateStepBom()
    {
    	$rules = [
    		'bom' => 'file'
    	];

    	return $this->validate($rules);
	}
	
	// End Steps for the "new" status.

    public function validateStepName()
    {
    	$rules = [
    		'name' => 'required'
    	];

    	return $this->validate($rules, $this->toArray());
    }

}
