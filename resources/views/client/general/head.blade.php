<head>
	<meta charset="UTF-8">
	<title>
		@if(View::hasSection('title'))
        	@yield('title'):
    	@endif

    	{{ config( "app.name") }}
	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

	@include('client.general._metadata')

	<link href="{{ config("cltvo.version_assets") ? elixir('bundle.css') :  asset('css/mazorca.css') }}" rel="stylesheet" type="text/css">

	{{-- Favicon --}}
	@include('general.favicon')

	{{-- jQuery --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	
	{{-- Scrollit --}}
	<script src="{{ asset('js/scrollIt.js') }}" type="text/javascript"></script>
	
	{{-- Swiper --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.2/js/swiper.min.js"></script>

	{{-- jQuery UI --}}
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>

	{{-- Tag Manager --}}
	@include('general.tag-manager')
	

</head>
