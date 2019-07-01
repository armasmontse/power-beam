 <div class="header__menu-mobil-toggler">
	<a href="{{ $user ? $user->getHomeUrl() : route("client::login:get") }}" class="header__button">Quote your project</a>
	<img id="img-JS-hamburger" class="header__menu-mobil-toggler-hamburger menu-mobil-toggler_JS" src="{{asset('images/icon-menu-mobile.svg')}}" alt="">
	<img id="img-JS-close" class="header__menu-mobil-toggler-hamburger--close menu-mobil-toggler_JS" src="{{asset('images/icon-menu-mobile--close.svg')}}" alt="">
 </div>
<div id="menu-mobil" class="header__menu-mobil">
	<nav class="">
		@if (config("cltvo.open_register") && config("cltvo.open_site"))
			<a href="{{route('client::register:get')}}" class="header__menu-mobil-link header__menu-mobil-link--sign-up">Sign up</a>
		@endif
		<a href="{{route('client::login:get')}}" class="header__menu-mobil-link header__menu-mobil-link--login">Log in</a>
		<a href="{{route("client::pages.index")}}#about" class="header__menu-mobil-link" data-scroll-nav="about">About</a>
	    <a href="{{route("client::pages.index")}}#process" class="header__menu-mobil-link" data-scroll-nav="process">Process</a>
	    <a href="{{route("client::pages.index")}}#reviews" class="header__menu-mobil-link" data-scroll-nav="reviews">Reviews</a>
	    <a href="{{route("client::pages.index")}}#contact" class="header__menu-mobil-link" data-scroll-nav="contact">Contact</a>
		<div style="padding-top: 20px">
	    	<a href="tel:{{ $contact_phone }}" class="header__menu-mobil-link header__menu-mobil-link--sm" style="padding-top: 20px">Questions? call us: {{ $contact_phone }}</a>
	    	<a href="mailto:{{ $contact_mail }}" class="header__menu-mobil-link header__menu-mobil-link--sm">{{ $contact_mail }}</a>
		</div>
	</nav>	
</div>