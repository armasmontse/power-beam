@extends('layouts.user')
@section('content')
<style>
	body {
		padding-top:100px;
	}
	.container-user {
		display:none;
	}
</style>
{{--  Lo desarrollado aquí es sólo el area de Drop, o click para subir archivo.   --}}
<file-uploader :file-data="null" name="avatar"></file-uploader>	

<file-uploader :file-data="{name: 'pepe.pecas', id:'1'}" name="avatar2"></file-uploader>	

@endsection

@section('vue_templates')
	@include('vue.file_uploader.file-uploader-template')
@endsection