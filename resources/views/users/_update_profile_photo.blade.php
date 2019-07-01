<div>

    {!! Form::open([
        'method'                => 'post',
        'route' 				=> ['user::archives.photos.ajax.store', $user->name],
        'role'                  => 'form' ,
        'id'                    => 'singleimageupdate_form',
        'enctype'               => "multipart/form-data"
    ]) !!}

        
    {!! Form::close() !!}

</div>
<div v-if="hasSingleImage">
    {!! Form::open([
        'method'                => 'delete',
        'route' 				=> ['user::archives.photos.ajax.disassociate', $user->name, '&#123;&#123;store.current_news.thumbnail_image.id&#125;&#125;'],
        'role'                  => 'form' ,
        'id'                    => 'singleimageremove_form',
    ]) !!}
        <div class="">
            <p class="" v-on:click="makePost('singleimageremove_form')">Cambiar Imagen</p>
            <input form="singleimageremove_form" type="hidden" name="use" value="thumbnail">
            <input form="singleimageremove_form" type="hidden" name="photoable_type" value="news">
            <input form="singleimageremove_form" type="hidden" name="photoable_id" value="{{$user->id}}">
        </div>
    {!! Form::close() !!}
</div>
