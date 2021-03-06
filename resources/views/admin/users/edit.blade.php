@extends('layouts.admin')

@section('title')
    {!! trans('manage_users.edit.label') !!}
@endsection

@section('h1')
    {!! trans('manage_users.edit.label') !!}
@endsection

@section('action')
    <a href="{{ route( 'admin::users.index' ) }}" class="btn-floating btn-icon">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')

    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_users.edit.instructions', ['name' => $user_edit->name])
    ])

    @include('admin.users._form',[
        "form_id"       => 'edit_user_form',
        "form_route"   => ['admin::users.update',$user_edit->id],
        "form_method"   => 'PATCH'
    ])

    @unless ($user_edit->id == $user->id)
		<div class="col s12 ">
			<div class="divider"></div>
		</div>

		<div class=" col s10 offset-s1">
			<roles-multi-select :list.sync="store.roles.data" :items-ids="store.current_user.roles_ids"></roles-multi-select>
		</div>
	@endunless

    <div class="input-field col s10 offset-s1">
        <h6 class=""><b>{!! trans('manage_users.create.form.photo.label') !!}</b></h6>
        <single-image
            :ref-path="'user'"
            :current-image="store.current_user.thumbnail_image"
            :photoable-id="store.current_user.id"
            photoable-type="user"
            default-order="null"
            use='thumbnail'
        ></single-image>
    </div>

@endsection

@section('modals')
    <media-manager v-ref:media_manager></media-manager>
@endsection

@section('vue_templates')
	@unless ($user_edit->id == $user->id)
	    @include('admin.users.roles._multi-select-template', [
		  'form_id' 		=> "update_roles-user_form",
		  'form_method'		=> "patch",
		  'form_route'		=> ["admin::users.ajax.roles",$user_edit->id],
		])
	@endunless

    @include('admin.media_manager.vue._modal-media_manager')
    @include('admin.media_manager.vue.single-image-template')

@endsection

@section('vue_store')
		<script>
			mainVueStore.current_user = {!! $user_edit !!};
            @unless ($user_edit->id == $user->id)
    			mainVueStore.roles = {
    				data: {!! json_encode($roles) !!}
    			};
            @endunless

		</script>
@endsection
