{{-- STEP 1	 --}}
<div class="card projects__card">
	
	<div class="card-content projects__card-content">
        
        <h4 class="fz-20 black-text projects__sbttl--step">Step 2. Upload BOM</h4>
        
		<p class="fz-16 projects__text">
			Please upload a complete BOM showing quantities, 
			Manufacturer’s name, Manufacturer’s part number, 
			and preferable Distributor’s name and Distributor’s Part number. <br>
			To download a template format that is guaranteed to parse <a href="{{ asset('/resources/PBARTK01.xls') }}" download class="projects__text-download">click here</a>.
		</p>

		<file-uploader :file-data="{{ $project->getFileByUse('bom') }}" name="bom_file"></file-uploader>

		<form action="{{ route('user::projects.bomFile', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in files">
			<input type="submit" value={{ trans('Save') }}>
		</form>

		{{-- <div class="center projects__card-center">
			<i class="material-icons">archive</i>
			<p class="black-text">Drag & drop your file here or</p>
			<a class="waves-effect waves-light btn">browse your files</a>
			<div class="progress">
				<div class="determinate" style="width: 70%"></div>
			</div>
			<p>PROCESSING: Bill of Materials-BCSMB01.xlsx</p>
		</div> --}}

	</div>

</div>