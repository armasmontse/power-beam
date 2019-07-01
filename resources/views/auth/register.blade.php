@extends('layouts.auth', ['body_id' => 'register-vue'])

@section('content')
	<div class="auth page">
		<div class="auth--wrap wrap">

			<div class="auth--ttl page-title">
				{!! trans('auth.register.label') !!}
			</div>
			<div class="auth--sbttl">
				{!! trans('auth.register.sbttl') !!}
			</div>
			<div class="auth--txt">
				<span>{!! trans('auth.register.text') !!}</span>
				<a href="{{ route('client::login:get') }}">
					<span class="auth--txt--red">{!! trans('auth.register.back_to_login') !!}</span>
				</a>
			</div>

			<form class="auth__form" role="form" method="POST" action="{{ route('client::register:post') }}">
				{{ csrf_field() }}
				<div class="auth__col-1-2">
					<input id="first_name" type="text" class="form--input" placeholder="{!! trans('auth.register.form.first_name.placeholder') !!}" name="first_name" value="{{ old('first_name') }}" required autofocus>
					<input id="last_name" type="text" class="form--input" placeholder="{!! trans('auth.register.form.last_name.placeholder') !!}" name="last_name" value="{{ old('last_name') }}" required autofocus>
					<input id="email" type="email" class="form--input" placeholder="{!! trans('auth.register.form.email.placeholder') !!}" name="email" value="{{ old('email') }}" required>
					<input id="phone" type="text" class="form--input" placeholder="{!! trans('auth.register.form.phone.placeholder') !!}" name="phone" value="{{ old('phone') }}" required autofocus>
				</div>
				<div class="auth__col-1-2">
					<input id="password" type="password" class="form--input" placeholder="{!! trans('auth.register.form.password.placeholder') !!}" name="password" required>
					<input id="password-confirm" type="password" class="form--input" placeholder="{!! trans('auth.register.form.password_confirmation.placeholder') !!}" name="password_confirmation" required>
					<input v-model="company_name" v-on:focus="companies_input_is_focused = true" id="company" type="text" class="form--input" placeholder="{!! trans('auth.register.form.company.placeholder') !!}" name="company" value="{{ old('company') }}" required autofocus>
					<div class="auth__autocomplete-container" v-if="showCompanyAutocomplete">
						<div class="auth__autocomplete">
							<p v-on:click.stop="selectCompanyName(name)" class="auth__autocomplete-option" v-for="name in availableCompanyNames" v-text="name"></p>
						</div>
					</div>
					<input id="job_position" type="text" class="form--input" placeholder="{!! trans('auth.register.form.job_position.placeholder') !!}" name="job_position" value="{{ old('job_position') }}" required autofocus>
				</div>
				<div class="auth__terms">
					<input type="checkbox" name="terms" id="terms">
					<label class="auth__terms-label" for="terms">{!! trans('auth.register.form.accept') !!} <a href="#" class="auth__terms--red">{!! trans('auth.register.form.terms') !!}</a> </label>
				</div>
				<div class="form--submit-container">
					<button type="submit" class="form--submit" style="float: left">
						{!! trans('auth.register.form.save') !!}
					</button>
				</div>
				
			</form>
		</div>
	</div>
@endsection

@section('vue_store')
<script>
	mainVueStore.companies = {!! $companies !!}

</script>
@endsection
