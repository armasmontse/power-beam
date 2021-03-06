<!DOCTYPE html>
<html lang="{{ $current_lang_iso }}">

	{{-- Head --}}
	@include('client.general.head')

	<body id="{{isset($body_id) ? $body_id : 'main-vue'}}"  >
		@include('general._alerts')
		{{-- Analytics --}}
	    @include('client.general.analytics')
		{{-- Header --}}
		@include('client.auth.header')



		<div class="main-wrap {{isset($main_wrap_class) ? $main_wrap_class : ''}}">

			@yield('content')

		</div>

		{{-- Footer --}}
		@include('client.general.footer')

		{{-- Scripts --}}
		@include('client.general.scripts')

	</body>

</html>
