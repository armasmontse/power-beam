@extends('layouts.auth')

@section('content')
	<div class="auth set page">
		<div class="set--wrap wrap">

			<div class="auth--ttl">
				{!! trans('auth.password_set.label') !!}
			</div>

			{!! Form::open([
				'method'	=> 'PATCH',
				'route'		=> ['client::pass_set:patch',$encode_email],
				'role'		=> 'form',
				'id'		=> 'set_pasword_form',
				'class'		=> 'auth__form'
				]) !!}

				<div class="auth__col-1-2">
					{!! Form::password('password', [
						'class' => 'auth__form--input form--input',
						'required' => 'required',
						'placeholder' => trans('auth.password_set.form.password.placeholder')
					]) !!}
				</div>

				<div class="auth__col-1-2">
					{!! Form::password('password_confirmation', [
						'class' => 'auth__form--input form--input',
						'required' => 'required',
						'placeholder' =>  trans('auth.password_set.form.password_confirmation.placeholder')
						]) !!}
				</div>

				<button type="submit" class="form--submit">
					{!! trans('auth.password_set.form.save') !!}
				</button>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
