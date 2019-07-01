<?php

namespace App\Http\Requests\Users\Projects;

use App\Http\Requests\Request;

class PendingInfoRequest extends Request
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
            // Step 1.1 Geometry
            "dwgFile" => 'required',//file
            // Step 1.2 Stackup
            "stackup" => 'required_without:thickness_number',//file

            "thickness_number" => 'required_without:stackup|numeric|min:0',
            "thickness_unity" => 'required_without:stackup',
            "cuterlayer" => 'required_without:stackup',
            "innerlayer1" => 'required_without:stackup',
            "innerlayer2" => 'required_without:stackup',
            // Step 1.3 Routing
            "routing_nets" => 'required_without:routing',
            "routing" => 'required_without:routing_nets',//file
            "trace_number" => 'required|numeric|min:0',
            "trace_unity" => 'required',
            "trace_trace_number" => 'required|numeric|min:0',
            "trace_trace_unity" => 'required',
            "hole_size_number" => 'required|numeric|min:0',
            "hole_size_unity" => 'required',
            "pad_size_number" => 'required|numeric|min:0',
            "pad_size_unity" => 'required',
            // Step 1.4 High-Speed
            "has_cpu" => 'required',
            "cpu_number" => 'required_if:has_cpu,true|numeric|min:0',
            "cpu_package" => 'required_if:has_cpu,true',
            "package_pitch" => 'required_if:has_cpu,true',
            "speenA1" => 'required_if:has_cpu,true',

            "interface_design" => 'required',
            "max_working_speed" => 'required_if:interface_design,true|string',

            "impedance_traces" => 'required',
            "dielectric_material" => 'required_if:interface_design,true|string',
            "dielectric_constant" => 'required_if:interface_design,true',
            "dielectric_constant_number" => 'required_if:interface_design,true|numeric|min:0',
            // Step 1.5 Power-Supply
            "power_nets" => 'required',
            "ground_nets" => 'required',
            // Step 1.6 Altium
            "altium" => 'required',//file

        ];
    }
}
