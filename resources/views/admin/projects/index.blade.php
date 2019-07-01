@extends('layouts.admin')

@section('title')
    {!! trans('manage_projects.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_projects.index.label') !!}
@endsection

@section('action')

@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_projects.index.instructions')
    ])

    <div class="col s12 l10 offset-l1">
        <div class="row">
            <projects :list="store.projects.data"></projects>
        </div>
	</div>

@endsection

@section('vue_templates')

    <script type="x/templates" id="projects-template">
		<div>
	        @include('admin.general._table-search')
			<div class="col s12">
	            @include('admin.projects.index._table')
	        </div>
		</div>
    </script>

@endsection

@section('vue_store')
    <script>
		 mainVueStore.projects = { data: {!! json_encode($projects) !!} };
    </script>
@endsection
