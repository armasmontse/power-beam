@extends('layouts.admin')

@section('title')
    {!! trans('manage_projects.show.label') !!}: {{ $project->name }}
@endsection

@section('h1')
    {!! trans('manage_projects.show.label') !!}: {{ $project->name }}
@endsection

@section('action')
	<a href="{{ route('admin::projects.edit', ['admin_project' => $project->id]) }}" class="btn-floating btn-icon">
	    <i class="material-icons waves-effect waves-light">mode_edit</i>
	</a>
@endsection

@section('content')

	{{-- {{ dd($project) }} --}}

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="row">
				<div class="col s12">
					<div class="card-panel grey lighten-3">
						Download all available files of this project <a class="link" href="{{ route('admin::projects.downloadFiles', ['admin_project' => $project->id]) }}">here</a>.
						<a href="{{ route('admin::projects.downloadFiles', ['admin_project' => $project->id]) }}" class="secondary-content"><i class="material-icons">file_download</i></a>
					</div>
				</div>
			</div>

			<br><br>

			<div class="row">
				<div class="col s12">
					<ul class="tabs">
						<li class="tab col s2">
							<a class="red-text text-darken-2" class="active" href="#info">Info</a>
						</li>
						<li class="tab col s2">
							<a class="red-text text-darken-2" href="#project-manager">Manager</a>
						</li>
						<li class="tab col s2">
							<a class="red-text text-darken-2" href="#user">User</a>
						</li>
						<li class="tab col s2">
							<a class="red-text text-darken-2" href="#status">Status</a>
						</li>
						<li class="tab col s2">
							<a class="red-text text-darken-2" href="#quotes">Quotes</a>
						</li>
						<li class="tab col s2">
							<a class="red-text text-darken-2" href="#notes">Notes</a>
						</li>
					</ul>
				</div>
				<div id="info" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.info')
				</div>
				<div id="project-manager" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.project-manager')
				</div>
				<div id="user" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.user')
				</div>
				<div id="status" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.status')
				</div>
				<div id="quotes" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.quotes')
				</div>
				<div id="notes" class="col s12 offset-l2 l8" style="padding: 30px 0;">
					@include('admin.projects.show.notes')
				</div>
			</div>

		</div>
	</div>

@endsection