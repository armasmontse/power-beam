<div v-if="passwordForm">

	{!! Form::open([
		'method'		=> 'PATCH',
		'route'			=> ['user::password.update', $user->name],
		'role'			=> 'form' ,
		'id'			=> 'update_password_form',
		'class'			=> 'user__container--gray',
	]) !!}

		<div class="user__container  user__ttl user__ttl--other-margin">
			{{trans('user.update_password.form_update.ttl')}}
		</div>

		<div class="user__container  input-field">
			<label for="old_password">{{ trans('user.update_password.form.old_password.placeholder') }}</label>
			{!! Form::password('old_password', [
				'class'			=> 'validate',
				'required'		=> 'required',
				'form'			=> 'update_password_form'
			]) !!}
		</div>

		<div class="user__container  input-field">
			<label for="password">{{ trans('user.update_password.form.password.placeholder') }}</label>
			{!! Form::password('password', [
				'class'			=> 'validate',
				'required'		=> 'required',
				'form'			=> 'update_password_form'
			]) !!}
		</div>

		<div class="user__container  input-field">
			<label for="password_confirmation">{{ trans('user.update_password.form.password_confirmation.placeholder') }}</label>
			{!! Form::password('password_confirmation', [
				'class'			=> 'validate',
				'required'		=> 'required',
				'form'			=> 'update_password_form'
			]) !!}
		</div>

		{!! Form::submit(trans('user.update_password.form_update.save_change'), [
			'class'	=> 'mt-10 user__container  waves-effect waves-light btn',
			'form'	=> 'update_password_form'
		]) !!}

		{{-- <a class="account--link" href="{{ route('client::pass_reset:get') }}">
			Olvidé mi Contraseña
		</a> --}}

	{!!Form::close()!!}

</div>
