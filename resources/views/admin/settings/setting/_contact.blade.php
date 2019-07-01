@include('admin.general._page-subtitle', ['title' => trans('manage_settings.contact.title') ])
{!! Form::open([
      'method'              => 'PATCH',
      'route'               => ['admin::settings.update', 'contact'],
      'role'                => 'form' ,
      'id'                  => 'update_setting-contact_form',
      'class'               => "col s10 offset-s1"
]) !!}

    <div class="row ">

        <div class="input-field col s12 ">

            {!! Form::label('phone', trans('manage_settings.contact.phone.label'), ['class' => '']) !!}

            {!! Form::text('phone', array_get($setting_contact,'phone'), [
                'class'         => 'validate',
                'form'          => 'update_setting-contact_form',
                'placeholder'   => trans('manage_settings.contact.phone.placeholder'),
                'required'      => 'required',
            ]) !!}

        </div>

        {{-- <div class="input-field col s12 ">

            {!! Form::label('address', trans('manage_settings.contact.address.label'), ['class' => '']) !!}

            {!! Form::textarea('address', array_get($setting_contact,'address'), [
                'class'         => 'validate materialize-textarea',
                'form'          => 'update_setting-contact_form',
                'placeholder'   => trans('manage_settings.contact.address.placeholder'),
                'required'      => 'required',
            ]) !!}

        </div> --}}

        <div class="col s12">

            <div class="pull-right">
                {!! Form::submit('guardar', [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => 'update_setting-contact_form',
                    ]) !!}
            </div>
        </div>
    </div>


{!! Form::close() !!}
