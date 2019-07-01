@extends('layouts.modal', ["modal_id"=> "companies-modal-edit"])

@section('modal-title')
    {!! trans('manage_companies.edit.label') !!}
@overwrite

@section('modal-content')
    {!! Form::open([
        'method'                => 'PATCH',
        'route'                 => ['admin::companies.ajax.update', '&#123;&#123;item_on_edit.id&#125;&#125;'],
        'role'                  => 'form' ,
        'id'                    => 'update_company-&#123;&#123;item_on_edit.id&#125;&#125;_form',
        'data-index'            => '&#123;&#123;editIndex&#125;&#125;',
        'v-on:submit.prevent'   => 'post'
    ]) !!}

        <div class=" col s12">
            {!! Form::text("name", null, [
                'class'         => 'validate',
                'required'      => 'required',
                'placeholder'   => "",
                'form'          => 'update_company-&#123;&#123;item_on_edit.id&#125;&#125;_form',
                'v-model'       => 'item_on_edit.name'
            ]) !!}
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit(trans('manage_companies.edit.save'), [
                    'class'  => 'btn waves-effect waves-light  ',
                    'form'   => 'update_company-&#123;&#123;item_on_edit.id&#125;&#125;_form'
                ]) !!}
            </div>
        </div>

    {!! Form::close() !!}
@overwrite
