<div class="projects__production-routing" id="routing">
	
	<h4 class="fz-20 black-text projects__sbttl--step">1.3. Routing</h4>

	<form action="{{ route('user::projects.pendingInfo.routing', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		{{-- Selected option --}}
		<input type="hidden" :value="optional_fields.routing" name="option">

		{{-- Files to attach --}}
		<div v-if="optional_fields.routing == 'file'">
			<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in filterFilesByUse('routing')">
		</div>
		
		<div class="projects__sbttl--stepA">

			<p>1.3.1. Number of routing nets or upload netlist. (A or B)</p>

			{{-- Requested fields --}}
			<div>
				<p>
					<input type="radio" v-model="optional_fields.routing" id="routing-input-checkbox" value="input" @if (old('option', array_get($project->production->routing, 'option', 'input')) == 'input') checked @endif>
					<label for="routing-input-checkbox">A.</label> Fill the requested fields. Supported formats: x, y, z
				</p>

				<input v-if="optional_fields.routing == 'input'" name="data[nets]" id="number" type="text" value="{{ old('data.nets', array_get($project->production->routing, 'data.nets', '')) }}" placeholder="Number of routing nets">
			</div>
		
			{{-- Input file --}}
			<div>
				<p>
					<input type="radio" id="routing-file-checkbox" v-model="optional_fields.routing" value="file" @if (old('option', array_get($project->production->routing, 'option', 'input')) == 'file') checked @endif>
					<label for="routing-file-checkbox">B.</label> Upload netlist file.
				</p>

				<file-uploader v-if="optional_fields.routing == 'file'" :file-data="{{ $project->getFileByUse('routing') }}" name="routing"></file-uploader>
			</div>

		</div>
		
		<div class="clearfix projects__sbttl--stepA">
			
			<p>1.3.2. Desired minimum trace width</p>
			
			<div class="input-field col s6">
				<div>
					<input name="data[trace][number]" id="trace_number" type="text" value="{{ old('data.trace.number', array_get($project->production->routing, 'data.trace.number', '5')) }}" class="validate">
					<label for="last_name">Trace width (number)</label>
				</div>
			</div>
			
			<div class="input-field col s6">
				<input name="data[trace][unity]" type="radio" id="2" value="mm" @if (old('data.trace.unity', array_get($project->production->routing, 'data.trace.unity', '')) == 'mm') checked @endif />
				<label for="2">mm</label>
				<input name="data[trace][unity]" type="radio" id="3" value="mils" @if (old('data.trace.unity', array_get($project->production->routing, 'data.trace.unity', 'mils')) == 'mils') checked @endif/>
				<label for="3">mils</label>
			</div>

		</div>
		
		<div class="clearfixb projects__sbttl--stepA">
			
			<p>1.3.3. Desired minimum trace to trace clearance</p>
			
			<div class="input-field col s6">
				<input name="data[trace_to_trace][number]" id="trace_trace_number" type="text" class="validate" value="{{ old('data.trace_to_trace.number', array_get($project->production->routing, 'data.trace_to_trace.number', '5')) }}">
				<label for="trace_trace_number">Trace to trace clearance (number)</label>
			</div>
			
			<div class="input-field col s6">
				<input name="data[trace_to_trace][unity]" type="radio" id="4" value="mm" @if (old('data.trace_to_trace.unity', array_get($project->production->routing, 'data.trace_to_trace.unity', '')) == 'mm') checked @endif />
				<label for="4">mm</label>
				<input name="data[trace_to_trace][unity]" type="radio" id="5" value="mils" @if (old('data.trace_to_trace.unity', array_get($project->production->routing, 'data.trace_to_trace.unity', 'mils')) == 'mils') checked @endif />
				<label for="5">mils</label>
			</div>

		</div>
		
		<div class="clearfix projects__sbttl--stepA projects__sbttl--padd5">
			
			<p>1.3.4. Minimum via size.</p>
			
			<div class="input-field col s6">
				<div>
					<input name="data[hole_size][number]" id="hole_size_number" type="text" class="validate" value="{{ old('data.hole_size.number', array_get($project->production->routing, 'data.hole_size.number', '10')) }}">
					<label for="hole_size_number">Hole size (number)</label>
				</div>
			</div>
			
			<div class="input-field col s6">
				<div>
					<input name="data[hole_size][unity]" type="radio" id="6" value="mm" @if (old('data.hole_size.unity', array_get($project->production->routing, 'data.hole_size.unity', '')) == 'mm') checked @endif />
					<label for="6">mm</label>
					<input name="data[hole_size][unity]" type="radio" id="7" value="mils" @if (old('data.hole_size.unity', array_get($project->production->routing, 'data.hole_size.unity', 'mils')) == 'mils') checked @endif />
					<label for="7">mils</label>
			    </div>
			</div>
		</div>
		
		<div class="clearfix">

			<div class="input-field col s6">
				<div>
					<input name="data[pad_size][number]" id="pad_size_number" type="text" class="validate" value="{{ old('data.pad_size.number', array_get($project->production->routing, 'data.pad_size.number', '18')) }}">
					<label for="pad_size_number">Pad size (number)</label>
				</div>
			</div>

			<div class="input-field col s6">
				<div>
					<input name="data[pad_size][unity]" type="radio" id="8" value="mm" @if (old('data.pad_size.unity', array_get($project->production->routing, 'data.pad_size.unity', '')) == 'mm') checked @endif />
					<label for="8">mm</label>
					<input name="data[pad_size][unity]" type="radio" id="9" value="mils" @if (old('data.pad_size.unity', array_get($project->production->routing, 'data.pad_size.unity', 'mils')) == 'mils') checked @endif  />
					<label for="9">mils</label>
			    </div>
			</div>

		</div>

		<div class="projects__card-content--btn">
			<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save routing" >
		</div>

	</form>

</div>

<div class="divider mb-50"></div>
