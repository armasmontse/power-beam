<!DOCTYPE html>
<html lang="es">

	@include('users.general.head')

	<body id="{{isset($body_id) ? $body_id : 'users-vue'}}" class="users">

		@include('general._alerts')

		{{-- Analytics --}}
	    @include('client.general.analytics')

		@include('users.general._header')

		<div style="display: flex; flex-direction: column; min-height: calc(100vh - 64px);">
			<div style="flex: 1;">
				@yield('content')
			</div>
			{{-- Footer --}}
			@include('users.general.footer')
		</div>

		@yield('modals')

		<projects-modal-create></projects-modal-create>

		@include('users.general.scripts')

		@yield('vue_templates')

		@include('users.projects._modal-create')

		{{-- Tag Manager --}}
		@include('general.tawkto')

	</body>

</html>
