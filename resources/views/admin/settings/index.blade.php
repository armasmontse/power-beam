@extends('layouts.admin')


@section('title')
    {!! trans('manage_settings.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_settings.index.label') !!}
@endsection


@section('content')

    {{-- Redes sociales --}}
    {{-- @include('admin.settings.setting._social')

    <div class="col s10 offset-s1">
        <br> <div class="divider"></div>
    </div> --}}

	{{-- contacto --}}
	@include('admin.settings.setting._contact')

	<div class="col s10 offset-s1">
		<br> <div class="divider"></div>
	</div>

    {{-- Mail --}}
	@include('admin.settings.setting._mail')
	
	<div class="col s10 offset-s1">
		<br> <div class="divider"></div>
	</div>

	@include('admin.general._page-subtitle', ['title' => 'Projects' ])

	<div class="row">
		<div class="col s10 offset-s1">
			<form action="{{ route('admin::settings.update', $new_projects->key) }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="col s12">
					<input id="disabled" type="checkbox" name="disabled" @if(array_get($new_projects->value, 'disabled')) checked="checked" @endif />
					<label for="disabled">Disable projects creation for users.</label><br><br>
				</div>
				@foreach($languages->pluck('iso6391') as $lang)
					<div class="input-field col s12">
						<label for="message[{{ $lang }}]" class="">Projects disabled message:</label>
						<textarea class="materialize-textarea" rows="2" cols="50" name="message[{{ $lang }}]" id="message[{{ $lang }}]">{{ array_get($new_projects->value, 'message.' . $lang) }}</textarea>
					</div>
				@endforeach
				<div class="input-field col s12">
					<button class="btn" type="submit">Save</button>
				</div>
			</form>
		</div>
	</div>

@endsection
