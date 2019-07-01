@extends('layouts.user', ['body_id' => 'projects-vue'])

@section('content')

	<div class="container-user container-height">
		<div class="row row-height">
			<div class="col s12 m3 l2 projects__navbar">
				@include('users.projects._nav')
			</div>
			<div class="col s12 m9 l10">
				<div class="col l10 offset-l1">
					@include('users.projects.show.' . $project->status->slug )
					@if (isset($step) && $project->status->hasSteps())
						@include('users.projects.show.' . $project->status->slug . '.' . $step->slug)
					@endif
				</div>
			</div>
		</div>
	</div>

	@include('users.projects._modal-show-error')

@endsection

@section('modals')
	@if ($project->status->slug == 'quoted')
		<projects-modal-reject-quote></projects-modal-reject-quote>
	@endif
@endsection

@section('vue_templates')
	@include('vue.file_uploader.file-uploader-template')
	@if ($project->status->slug == 'quoted')
		@include('users.projects._modal-reject-quote')
	@endif
@endsection

@section('vue_store')
	<script>
		mainVueStore.project = {!! $project !!}
	</script>
@endsection
