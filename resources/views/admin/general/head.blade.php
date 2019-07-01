<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
		@if(View::hasSection('title'))
        	@yield('title') &lsaquo;
    	@endif

    	{!! trans('admin.layout.admin_title') !!} &ndash; {{ config( "app.name") }}
	</title>

	<!-- Material icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

	{{-- Favicon --}}
	@include('general.favicon')

	<!-- Styles -->
	<link href="{{ config("cltvo.version_assets") ?  elixir('admin-bundle.css') : asset('css/admin.css')}}"  type="text/css" rel="stylesheet">

	<!-- include summernote css/js-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet" />
	{{-- <link rel="stylesheet" href="{{ asset('css/materialNote.css') }}"> --}}
</head>
