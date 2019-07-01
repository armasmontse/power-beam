<div id="menu-main" class="header__menu-container">
	<nav class="header__wrap header__menu-wrap" id="">
	
		<a class="header__logo" href="{{route("client::pages.index")}}">
			<img class="header__logo--img" src="{{ asset('images/PB-logo-menu.png') }}">
		</a>

		<div class="header__menu">
			<a href="{{route("client::pages.index")}}#about" class="header__item" data-scroll-nav="about">About</a>
			<a href="{{route("client::pages.index")}}#process" class="header__item" data-scroll-nav="process">Process</a>
			<a href="{{route("client::pages.index")}}#reviews" class="header__item" data-scroll-nav="reviews">Reviews</a>
			<a href="{{route("client::pages.index")}}#contact" class="header__item" data-scroll-nav="contact">Contact</a>
		</div>

		@if (Auth::user())
			<a href="{{ route('user::projects.index', ['user' => $user]) }}" class="header__button">{{ trans('Quote your project') }}</a>
		@else
			<a href="{{ route("client::login:get") }}" class="header__button">{{ trans('Quote your project') }}</a>
		@endif

	</nav>
</div>
