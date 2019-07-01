<div id="geometry">

	<h4 class="fz-20 black-text projects__sbttl--step">1.1. Geometry info</h4>

	<p class="fz-16 projects__text">
		Board Outline: Please attach a DWG/DXF file with board outline and holes data.
		If you don’t have a DWG/DXF file or you want to give specific information about the geometry of the board, upload a drawing with all important measures, holes (plated/unplated), keepouts, slots, etc.
	</p>

	<file-uploader :file-data="{{ $project->getFileByUse('dwg_') }}" name="dwgFile"></file-uploader>
	
	<form action="{{ route('user::projects.pendingInfo.geometry', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in filterFilesByUse('dwgFile')">

		<div class="projects__card-content--btn">
			<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save geometry" >
		</div>

	</form>

</div>

<div class="divider mb-50"></div>
