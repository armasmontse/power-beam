@extends('layouts.admin')

@section('title')
	{!! trans('manage_companies.index.label') !!}
@endsection

@section('h1')
	{!! trans('manage_companies.index.label') !!}
@endsection

@section('action')
	<span  data-target="companies-modal-create" class=" modal-trigger btn-floating  ">
		<i class="material-icons waves-effect waves-light " >add</i>
	</span>
@endsection

@section('content')
    <companies :list="store.companies.data"></companies>
@endsection

@section('modals')

@endsection

@section('vue_templates')
	@include('admin.users.companies._modal-create')
	@include('admin.users.companies._modal-edit')
	<script type="x/templates" id="companies-template">
		<div class="">

			@include('admin.general._page-instructions', [
				'title'		 	=> '',
				'instructions'	=> trans('manage_companies.index.instructions')
			])

			@include('admin.general._table-search')
			@include('admin.users.companies._table')

			<companies-modal-create :list.sync="list" ></companies-modal-create>
			<companies-modal-edit :list.sync="list" :edit-index="edit_index"></companies-modal-edit>
		</div>
	</script>
@endsection

@section('vue_store')
    <script>
	mainVueStore.companies = {
	   data: undefined, //IMPORTANTE: tenemos que registrar esta propiedad para que el get deposite lo recibido ahí, y SOBRETODO  para que el sistema de reactividad de Vue funcione adecuadamente
	   routes: {
		   get: '{{route('admin::companies.ajax.index')}}'
	   }
   };
    </script>
@endsection
