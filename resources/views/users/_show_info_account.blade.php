{!! Form::open([
    'method'                => 'PATCH',
    'route'                 => ['user::update', $user->name],
    'role'                  => 'form' ,
    'id'                    => 'show_info_account',
    'class'                 => 'user__container',
]) !!}

    <div class="user__ttl">
        {{trans('admin.layout.sidebar.my_account')}}
    </div>

    <div class="input-field col s10 projects__nopadd">
        <h6 class="left projects__user-label"><b>{!! trans('manage_users.create.form.photo.label') !!}</b></h6>
    </div>

    <div class="projects__user-image">
        <input type="file" class="inputfile" form="singleimageupdate_form" name="image" id="image" v-on:change="makePost('singleimageupdate_form')" />
        <label for="image" :style="{ backgroundImage: 'url(' + store.current_user.thumbnail_image.url + ')' }">
            <div v-if="!store.current_user.thumbnail_image.url">
                <span class="fa fa-camera"></span>
                <span>Agregar</span>
            </div>
        </label>
        <label class="change-image" for="image" v-if="!store.current_user.thumbnail_image.url">Agregar imágen</label>
        <label class="change-image" for="image" v-else>Cambiar imagen</label>
        <input form="singleimageupdate_form" type="hidden" name="use" value="thumbnail">
        <input form="singleimageupdate_form" type="hidden" name="photoable_type" value="user">
        <input form="singleimageupdate_form" type="hidden" name="photoable_id" value="{{ $user->id }}">
    </div>

    <div class="input-field">
        <label for="name">{{ trans('user.show_info.form.name.placeholder') }}</label>
        {!! Form::text('name', $user->first_name, [
            'class'         => 'validate',
            'form'          => 'show_info_account',
            'id'            =>  'name',
            'placeholder'   =>  ''
        ]) !!}
    </div>

    <div class="input-field">
        <label class="active" for="last_name">{{ trans('user.show_info.form.last_name.placeholder') }}</label>
        {!! Form::text('last_name', $user->last_name, [
            'class'         =>  'validate',
            'form'          =>  'show_info_account',
            'id'            =>  'last_name',
            'placeholder'   =>  ''
        ]) !!}
    </div>

    <div class="input-field company">
        <label for="company_name">{{ trans('user.show_info.form.company_name.placeholder') }}</label>
        {!! Form::text('company_name', !is_null($user->company) ? $user->company->name: '', [
            'class'         => 'validate',
            'form'          => 'show_info_account',
            'id'            => 'company_name',
            'placeholder'   => '',
            'disabled'      => '',

        ]) !!}
    </div>
    
    <label class="bla">{{ trans('user.show_info.form.company_name.alert') }}</label><br>

    <div class="input-field">
        <label for="job_place">{{ trans('user.show_info.form.job_place.placeholder') }}</label>
        {!! Form::text('job_place', $user->job_position, [
            'class'         =>  'validate',
            'form'          =>  'show_info_account',
            'id'            =>  'job_place',
            'placeholder'   =>  ''
        ]) !!}
    </div>
    
    <div class="input-field">
        <label for="phone">{{ trans('user.show_info.form.phone.placeholder') }}</label>
        {!! Form::text('phone', $user->phone, [
            'class'         => 'validate',
            'form'          => 'show_info_account',
            'id'            =>  'phone',
            'placeholder'   =>  ''
        ]) !!}
    </div>

    <div class="">
        <div class="input-field">
            <label for="email">{{ trans('user.show_info.form.email.placeholder') }}</label>
            {!! Form::email('email', $user->email, [
                'class'         =>  'validate',
                'required'      =>  'required',
                'form'          =>  'show_info_account',
                'type'          =>  'text',
                'disabled'      =>  'disabled',
                'placeholder'   =>  ''

            ]) !!}
            <span v-on:click="emailForm = !emailForm" class="link-red right">{{ trans('user.update_email.form_update.ttl') }}</span>
        </div>
    </div>

    <div class="input-field">
        <label for="password">{{ trans('user.show_info.form.password.placeholder') }}</label>
        {!! Form::password('email', [
            'class'         =>  'validate',
            'required'      =>  'required',
            'form'          =>  'show_info_account',
            'disabled'      =>  'disabled',
            'placeholder'   =>  '********'
        ]) !!}
        <span v-on:click="passwordForm = !passwordForm" class="link-red right">{{ trans('user.update_password.form_update.ttl') }}</span>
    </div>

    <div class="mt-10">
        {!! Form::submit(trans('user.show_info.form.save_update'), [
            'class' => 'mt-10 waves-effect waves-light btn left-align paddTop-10',
            'form'  => 'show_info_account',
        ]) !!}
    </div>

{!!Form::close()!!}
