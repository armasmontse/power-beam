@extends('layouts.auth')

@section('content')
	<div class="auth page">

		<div class="auth--ttl">
			{!! trans('auth.password_reset_email.label') !!}
		</div>
		<div class="auth--sbttl">
			{!! trans('auth.password_reset_email.sbttl') !!}
		</div>
		<div class="auth--txt">
			<a class="auth__links--password auth__links--link" href="{{ route('client::login:get') }}">
				{!! trans('auth.password_reset_emailform.label') !!}
			</a>
		</div>
		<form class="auth__form" role="form" method="POST" action="{{ route('client::pass_reset_email') }}">
			{{ csrf_field() }}
			<div class="auth__col-1-2">
				<div class="email__input-container">
					<input id="email" type="email" class="form--input" placeholder="{!! trans('auth.password_reset_emailform.email.placeholder') !!}" name="email" value="{{ old('email') }}" required>
				</div>
			</div>

			<div class="form--submit-container">
				<button type="submit" class="form--submit" style="float: left">
					{!! trans('auth.password_reset_emailform.save') !!}
				</button>
			</div>
		</form>
	</div>
@endsection
