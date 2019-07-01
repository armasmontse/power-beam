<div id="altium">
	<h4 class="fz-20 black-text projects__sbttl--step">1.6. Upload Altium and Orcad</h4>
	
	<p class="clearfix mb-50 fz-16 projects__text">
		You can use ZIP files. <br>
		We currently accept only Altium and Orcad files for rapid service. If you have a
		different file format, we can import it into Altium or Orcad, but the importers often
		introduce errors, and so you would have to thoroughly check the results before
		proceeding to layout.
	</p>
	
	<file-uploader :file-data="{{ $project->getFileByUse('data') }}" name="altium"></file-uploader>

	<form action="{{ route('user::projects.pendingInfo.altium', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

		{{ csrf_field() }}
		{{ method_field('PATCH') }}

		<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in filterFilesByUse('altium')">

		<div class="projects__card-content--btn">
			<input class="waves-effect waves-light btn btn-golden" type="submit" value="Save file" >
		</div>

	</form>
	
</div>

<div class="divider mb-50"></div>
