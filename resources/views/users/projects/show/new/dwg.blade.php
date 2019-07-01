{{-- STEP 2	 --}}
<div class="card projects__card">
	<div class="card-content projects__card-content">
        <h4 class="fz-20 black-text projects__sbttl--step">Step 3. Upload DWG/DXF </h4>
		<p class="fz-16 projects__text">The mechanical constraints are critical to a fast, proper layout.  <br>
			Please provide a DWG or DXF showing the coordinates of the Board Outline, Connectors, 
			Holes (plated and unplated) or Slots, Keepouts, including height limitations.  Be explicit 
			<a href="#" class="projects__text-download">Here</a> is sample of a proper physical description. <br>  
			If your board is very simple, send us a PDF drawing showing all on the necessary inputs.  
			This will be more expensive than sending a proper, explicit drawing. <br>
			If you have any question about this step, please jump on the chat right now. 
		</p>

		<file-uploader :file-data="{{ $project->getFileByUse('dwg') }}" name="dwg_file"></file-uploader>

		<form action="{{ route('user::projects.dwgFile', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in files">
			<input type="submit" value={{ trans('Save') }}>
		</form>

		{{-- <div class="center projects__card-center">
			<div class="archive--load">
				<i class="material-icons">archive</i>
			</div>
			<p class="black-text">Name archive.pdf</p>
			<button class="projects__card-center--delete red-link">Erase</button>
		</div> --}}

	</div>
</div>
