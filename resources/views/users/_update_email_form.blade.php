<div v-if="emailForm">

    {!! Form::open([
        'method'                => 'PATCH',
        'route'                 => ['user::email.update', $user->name],
        'role'                  => 'form' ,
        'id'                    => 'update_email_form',
        'class'                 => 'user__container--gray ',
    ]) !!}

        <div class="user__container user__ttl user__ttl--other-margin">
            {{trans('user.update_email.form_update.ttl')}}
        </div>

        <div class="user__container input-field">
            <label for="new-email">{{ trans('user.update_email.form.email.placeholder') }}</label>
            {!! Form::email('new_email', null, [
                'class'         =>  'validate',
                'required'      =>  'required',
                'form'          =>  'update_email_form',
                'type'          =>  'text',
            ]) !!}
        </div>

        <div class="user__container input-field">
            <label for="password">{{ trans('user.update_email.form.password.placeholder') }}</label>
            {!! Form::password('password', [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => 'update_email_form',
            ]) !!}
        </div>

        <div class="user__container ">
            {!! Form::submit(trans('user.update_email.form_update.save_change'), [
                'class' => 'mt-10 waves-effect waves-light btn left-align',
                'form'  => 'update_email_form',

            ]) !!}
        </div>

    {!!Form::close()!!}

</div>
