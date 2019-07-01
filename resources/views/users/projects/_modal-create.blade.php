@extends('layouts.modal', ["modal_id" => "projects-modal-create"])

@section('modal-title')
	{{ trans('user.new_project.title') }}
	@if(setting('new_projects.disabled') != 'on')
		<span>{{ trans('user.new_project.sbtitle') }}</span>
	@endif
@overwrite

@section('modal-content')
	@if(setting('new_projects.disabled') == 'on')
		{{ __setting('new_projects.message') }}
	@else
		<form class="" method="POST" action="{{ route('user::projects.store', $user) }}">
			{{ csrf_field() }}
			<input class="" name="name" required="required" placeholder="Project Name" type="text" value="{{ old('name') }}">
			<button type="submit" class="right projects__link back-trans">{{ trans('manage_projects.empty.link') }}</a>
		</form>
	@endif
@overwrite
