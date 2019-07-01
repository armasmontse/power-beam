{{-- STEP 3	 --}}
<div class="card projects__card">
	<div class="card-content projects__card-content">
        
        <h4 class="fz-20 black-text projects__sbttl--step">Step 4. Upload Altium and Orcad or Data Inputs (A or B)</h4>

        <p>
	        <input type="radio" id="file-checkbox" v-model="optional_fields.data" value="file" @if (array_get($project->production->data, 'option', 'file') == 'file') checked @endif>
	        <label for="file-checkbox">A.</label>
	    </p>
        
        <p class="fz-16 projects__text">
			Please either upload almost complete schematic design files (Altium or Orcad),
			or if you don’t have them, please answer the questions below.
		</p>

		<file-uploader v-if="optional_fields.data == 'file'" :file-data="{{ $project->getFileByUse('data') }}" name="data_input"></file-uploader>

		<p>
			<input type="radio" v-model="optional_fields.data" id="input-checkbox" value="input" @if (array_get($project->production->data, 'option', 'file') == 'input') checked @endif>
			<label for="input-checkbox">B.</label>
		</p>

		<p>Fill in the fields.</p>

		<form action="{{ route('user::projects.data', ['user' => $project->user, 'user_project' => $project]) }}" method="POST" class="projects__card-content--form">

			{{ csrf_field() }}
			{{ method_field('PATCH') }}

			<input type="hidden" :value="optional_fields.data" name="option">
			
			<div v-if="optional_fields.data == 'file'">
				<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in files">
			</div>

			<div v-if="optional_fields.data == 'input'">
				<div class="input-field col s6">
		          <input id="number_of_nets" name="data[number_of_nets]" type="number" min="0" class="validate" value="{{ old('data.number_of_nets', array_get($project->production->data, 'data.number_of_nets', '')) }}">
		          <label for="number_of_nets">Number of nets</label>
		        </div>

		        <div class="input-field col s6">
		          <input id="number_BGA_components" name="data[number_BGA_components]" type="number" min="0" class="validate" value="{{ old('data.number_BGA_components', array_get($project->production->data, 'data.number_BGA_components', '')) }}">
		          <label for="number_BGA_components">Number of impedance controlled nets</label>
		        </div>

		        <div class="input-field col s6">
		          <input id="number_impedance" name="data[number_impedance]" type="number" min="0" class="validate" value="{{ old('data.number_impedance', array_get($project->production->data, 'data.number_impedance', '')) }}">
		          <label for="number_impedance">Number of BGA components</label>
		        </div>

		        <div class="input-field col s6">
		          <input id="number_BGA_balls" name="data[number_BGA_balls]" type="number" min="0" class="validate" value="{{ old('data.number_BGA_balls', array_get($project->production->data, 'data.number_BGA_balls', '')) }}">
		          <label for="number_BGA_balls">Number of BGA solder balls</label>
		        </div>

			</div>

			<div class="projects__card-content--btn">
				<button class="waves-effect waves-light btn">SAVE</button>
			</div>

		</form>
		
	</div>
</div>
