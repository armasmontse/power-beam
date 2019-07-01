@extends('layouts.auth')

@section('content')
	<div class="auth page">
		<div class="auth--wrap wrap">

			<div class="auth--ttl page-title">
				{!! trans('auth.login.label') !!}
			</div>
			<div class="auth--sbttl">
				{!! trans('auth.login.sbttl') !!}
			</div>
			@if (config("cltvo.open_register") && config("cltvo.open_site"))
				<div class="auth--txt">
					<span>{!! trans('auth.login.text') !!}</span>
				      <a class="" href="{{ route('client::register:get') }}">
						  <span class="auth--txt--red">
				          	{!! trans('auth.login.sign_in') !!}
						  </span>
				      </a>
				 </div>
			 @endif
			<form class="auth__form" role="form" method="POST" action="{{ route('client::login:post') }}">
				{{ csrf_field() }}
				<div class="auth__col-1-2">
					<input id="email" type="email" class="auth__form--input form--input" placeholder="{!! trans('auth.login.form.email.placeholder') !!}" name="email" value="{{ old('email') }}" required autofocus>
				</div>
				<div class="auth__col-1-2">
					<input id="password" type="password" class="auth__form--input form--input" placeholder="{!! trans('auth.login.form.password.placeholder') !!}" name="password" required>
				</div>
				<a class="auth__links--password auth__links--link" href="{{ route('client::pass_reset:get') }}">
					{!! trans('auth.password_reset_email.label') !!}
				</a>
				<div class="form--submit-container">

					<button type="submit" class="form--submit" style="float: left">
						{!! trans('auth.login.form.enter') !!}
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection
