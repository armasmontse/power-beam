<div id="stackup">
	
	<h4 class="fz-20 black-text projects__sbttl--step">1.2. Stackup info (A or B):</h4>

	<form action="{{ route('user::projects.pendingInfo.stackup', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<input type="hidden" :value="optional_fields.stackup" name="option">

		<div v-if="optional_fields.stackup == 'file'">
			<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in filterFilesByUse('stackup')">
		</div>
	
		<div>
			<div>
				<p>
					<input type="radio" id="file-checkbox" v-model="optional_fields.stackup" value="file" @if (old('option', array_get($project->production->stackup, 'option', 'file')) == 'file') checked @endif>
					<label for="file-checkbox">A.</label> Upload a layer stack file
				</p>

				<file-uploader v-if="optional_fields.stackup == 'file'" :file-data="{{ $project->getFileByUse('stackup') }}" name="stackup"></file-uploader>
			</div>

			<div>
				<p>
					<input type="radio" v-model="optional_fields.stackup" id="input-checkbox" value="input" @if (old('option', array_get($project->production->stackup, 'option', 'file')) == 'input') checked @endif>
					<label for="input-checkbox">B.</label> Fill in these fields.
				</p>

				<div class="projects__card-content--form" v-if="optional_fields.stackup == 'input'">
					<div class="input-field col s6">
						<div>
							<input name="data[thickness][number]" id="thickness_number" type="text" class="validate" value="{{ old('data.thickness.number', array_get($project->production->stackup, 'data.thickness.number', '')) }}">
							<label for="last_name">Overall thickness (number)</label>
						</div>
						{{ Form::select('data[cuterlayer]', [
							'' => 'Pick the Outer Layers thickness',
							'0.25 oz' => '0.25 oz',
							'0.5 oz' => '0.5 oz',
							'1 oz' => '1 oz',
							'1.5 oz' => '1.5 oz',
							'2 oz' => '2 oz',
							'2.5 oz' => '2.5 oz',
						], old('data.cuterlayer', array_get($project->production->stackup, 'data.cuterlayer', '')), [
							'class' => 'projects__production-select'
						]) }}
						{{ Form::select('data[innerlayer][first]', [
							'' => 'Pick the Inner Layers thickness',
							'0.25 oz' => '0.25 oz',
							'0.5 oz' => '0.5 oz',
							'1 oz' => '1 oz',
							'1.5 oz' => '1.5 oz',
							'2 oz' => '2 oz',
							'2.5 oz' => '2.5 oz',
						], old('data.cuterlayer.first', array_get($project->production->stackup, 'data.innerlayer.first', '')), [
							'class' => 'projects__production-select'
						]) }}
						{{ Form::select('data[innerlayer][second]', [
							'' => 'Number og layers',
							'2' => '2',
							'4' => '4',
							'6' => '6',
							'8' => '8',
							'10' => '10',
							'12' => '12',
							'14' => '14',
							'16' => '16',
						], old('data.innerlayer.second', array_get($project->production->stackup, 'data.innerlayer.second', '')), [
							'class' => 'projects__production-select'
						]) }}
			        </div>
			        <div class="input-field col s6">
			        	<div class="flex projects__card-content-flex">
						    <div>
						      <input name="data[thickness][unity]" type="radio" id="1" value="mm" @if (old('data.thickness.unity', array_get($project->production->stackup, 'data.thickness.unity', '')) == 'mm') checked @endif/>
						      <label for="1">mm</label>
						      <input name="data[thickness][unity]" type="radio" id="1.2" value="mils" @if (old('data.thickness.unity', array_get($project->production->stackup, 'data.thickness.unity', 'mils')) == 'mils') checked @endif/>
						      <label for="1.2">mils</label>
						    </div>
					   		<div><p>Our team will determine if the number of selected layers is sufficient to route the type and number of devices in your design</p></div>
			          	</div>
			        </div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="projects__card-content--btn">
			<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save stackup" >
		</div>

	</form>

</div>

<div class="divider mb-50"></div>
