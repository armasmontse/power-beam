<div id="micro-menu" class="header__micro-menu">
	<div class="grid__row  " >
		<div class="grid__container grid__container--no-pad">

			<div class="splash__contact splash__contact--initial">
			  <div class="splash__contact__1-3">
			    Questions? call us: {{ $contact_phone }}
			  </div>

			  <div class="splash__contact__1-3">
			  	<nav>
					@if (isset($in_auth) && $in_auth)
						<a href="{{ route('client::pages.index') }}">Home </a>
					@else
						@if ($user)
							@if ($user->hasPermission("admin_access"))
							<a href="{{route('admin::index')}}">Admin</a> |
							@endif
							<a href="{{$user->getHomeUrl()}}">My Account </a>
						@else
							@if (config("cltvo.open_register") && config("cltvo.open_site"))
							<a href="{{route('client::register:get')}}">Sign up</a> |
							@endif
							<a href="{{route('client::login:get')}}">Log in</a>
						@endif
					@endif
				</nav>
			  </div>

			  <div class="splash__contact__1-3">
			    {{ $contact_mail }}
			  </div>
			</div>

		</div>
	</div>
</div>
