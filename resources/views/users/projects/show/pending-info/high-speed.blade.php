<div id="highspeed">

	<h4 class="fz-20 black-text projects__sbttl--step mb-50">1.4. High speed</h4>

	<form action="{{ route('user::projects.pendingInfo.highspeed', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		{{-- Selected option --}}
		<input type="hidden" value="input" name="option">

		<p class="clearfix mb-50 fz-16 projects__text">1.4.1. Are there any CPU on your design?</p>

		<div class="input-field flex-row mb-50">
			<p>
				<input name="data[has_cpu]" type="radio" id="15" value="No" v-model="has_cpu" @if (old('data.has_cpu', array_get($project->production->highspeed, 'data.has_cpu', '')) == 'No') checked @endif />
				<label for="15">No</label>
			</p>
			<p>
				<input name="data[has_cpu]" type="radio" id="16" value="Yes" v-model="has_cpu" @if (old('data.has_cpu', array_get($project->production->highspeed, 'data.has_cpu', '')) == 'Yes') checked @endif />
				<label for="16">Yes</label>
			</p>
		</div>

		<div id="high_speed-add" class="row mb-50" v-if="has_cpu == 'Yes'">

			<div class="col s8 input-field padd-0">
				<input id="cpu_number" name="data[cpu_number]" type="text" class="validate" value="{{ old('data.cpu_number', array_get($project->production->highspeed, 'data.cpu_number', '')) }}">
				<label for="data[cpu_number]">How many CPU? (number)</label>
			</div>

			<div class="col s4 input-field padd-0" style="margin-top: 0;">
				<input name="data[cpu_package]" type="radio" id="bga_package" value="BGA package" @if (old('data.cpu_package', array_get($project->production->highspeed, 'data.cpu_package', '')) == 'BGA package') checked @endif >
				<label for="bga_package">BGA package</label>
				<input name="data[cpu_package]"  type="radio" id="pga_package" value="PGA package" @if (old('data.cpu_package', array_get($project->production->highspeed, 'data.cpu_package', '')) == 'PGA package') checked @endif >
				<label for="pga_package">PGA package</label>
			</div>

			<div class="col s8 input-field padd-0">
				<input id="package_pitch" name="data[package_pitch]" type="text" class="validate" value="{{ old('data.package_pitch', array_get($project->production->highspeed, 'data.package_pitch', '')) }}">
				<label for="package_pitch">Package pitch (number)</label>
			</div>

			<div class="col s4 input-field padd-0">
				<input name="data[speenA1]" type="radio" id="10" value="mm" @if (old('data.speenA1', array_get($project->production->highspeed, 'data.speenA1', '')) == 'mm') checked @endif >
				<label for="10">mm</label>
				<input name="data[speenA1]" type="radio" id="11" value="mils" @if (old('data.speenA1', array_get($project->production->highspeed, 'data.speenA1', '')) == 'mils') checked @endif >
				<label for="11">mils</label>
			</div>

	    </div>

		<p class="clearfix mb-50 fz-16 projects__text clearfix">1.4.2. Are there any memory interfaces on your design?</p>

		<div class="input-field flex-row mb-50">
			<p>
				<input name="data[interface_design]" type="radio" id="12" value="No" v-model="has_memory_interfaces" @if (old('data.interface_design', array_get($project->production->highspeed, 'data.interface_design', '')) == 'No') checked @endif>
				<label for="12">No</label>
			</p>
			<p>
				<input name="data[interface_design]" type="radio" id="13" value="Yes" v-model="has_memory_interfaces" @if (old('data.interface_design', array_get($project->production->highspeed, 'data.interface_design', '')) == 'Yes') checked @endif>
				<label for="13">Yes</label>
			</p>
		</div>

		<!---Aparece cuando das click en New card---->
		<div id="interface_design-add" class="mb-50 row" style="" v-if="has_memory_interfaces == 'Yes'">
			<div class="col s10 offset-s1 input-field">
				<p class="fz-16 projects__text">What’s the maximum working speed of your devices:</p>
				<textarea name="data[max_working_speed]" id="max_working_speed" class="textarea" style="width: 100%;" placeholder="Maximum working speed">{{ old('data.max_working_speed', array_get($project->production->highspeed, 'data.max_working_speed', '')) }}</textarea>
			</div>
	    </div>

		<p class="clearfix mb-50 fz-16 projects__text clearfix">1.4.3. Are there any impedance controlled traces?</p>

		<div class="input-field flex-row mb-50">
			<p>
				<input name="data[impedance_traces]" type="radio" id="12.1" value="No" v-model="has_impedance_traces" @if (old('data.impedance_traces', array_get($project->production->highspeed, 'data.impedance_traces', '')) == 'No') checked @endif>
				<label for="12.1">No</label>
			</p>
			<p>
				<input name="data[impedance_traces]" type="radio" id="13.1" value="Yes" v-model="has_impedance_traces" @if (old('data.impedance_traces', array_get($project->production->highspeed, 'data.impedance_traces', '')) == 'Yes') checked @endif>
				<label for="13.1">Yes</label>
			</p>
		</div>

		<!---Aparece cuando das click en New card---->
		<div id="interface_design-add" class="row mb-50" style="" v-if="has_impedance_traces == 'Yes'">
			<div class="col s10 offset-s1 input-field mb-50">
				<p class="fz-16 projects__text">Dielectric material:</p>
				<textarea name="data[dielectric_material]" id="dielectric_material" class="textarea" style="width: 100%;" placeholder="Dielectric material:">{{ old('data.dielectric_material', array_get($project->production->highspeed, 'data.dielectric_material', '')) }}</textarea>
			</div>
			<div class="col s8 offset-s2 input-field">
				<input id="dielectric_constant" name="data[dielectric_constant]" type="text" class="validate" value="{{ old('data.dielectric_constant', array_get($project->production->highspeed, 'data.dielectric_constant', '')) }}">
				<label for="dielectric_constant">Dielectric constant (number)</label>
			</div>
	    </div>

	    <div class="projects__card-content--btn">
	    	<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save highspeed" >
	    </div>

	</form>

</div>

<div class="divider mb-50"></div>
