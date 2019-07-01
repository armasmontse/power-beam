<div id="power-supply">
	<h4 class="fz-20 black-text projects__sbttl--step mb-50">1.5. Power supply</h4>
	
	<form action="{{ route('user::projects.pendingInfo.powerSupply', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<input type="hidden" value="input" name="option">
		<div class="input-field">
			<input id="power_nets" type="number" min="0" name="data[power_nets]" class="validate" value="{{ old('data.power_nets', array_get($project->production->power_supply, 'data.power_nets', '')) }}">
			<label for="power nets">Number of power regulators or converters (power nets)</label>
		</div>
		<div class="input-field">
			<input id="ground_nets" type="number" min="0" name="data[ground_nets]" class="validate" value="{{ old('data.ground_nets', array_get($project->production->power_supply, 'data.ground_nets', '')) }}">
			<label for="ground_nets">Number of ground nets</label>
		</div>
		<div class="projects__card-content--btn">
			<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save power supply" >
		</div>
	</form>

</div>

<div class="divider mb-50"></div>
