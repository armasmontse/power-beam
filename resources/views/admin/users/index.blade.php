@extends('layouts.admin')


@section('title')
    {!! trans('manage_users.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_users.index.label') !!}
@endsection

@section('action')
    <a href="{{ route( 'admin::users.create' ) }}" class="btn-floating btn-icon">
        <i class="material-icons waves-effect waves-light " >add</i>
    </a>
@endsection

@section('content')

	<users :list="store.users.data"></users>

@endsection

@section('vue_templates')
    <script type="x/templates" id="users-template">
		<div class="">
			{{-- filtros por: industria, nombre, apellido, empresa --}}
			@include('admin.general._table-search')
		    <div class="col s10 offset-s1">
		        @include('admin.users.index._table')
		    </div>
		</div>
    </script>
@endsection

@section('vue_store')

    <script>
        mainVueStore.users = {
            data: {!! json_encode($users) !!}
        }
    </script>

@endsection
