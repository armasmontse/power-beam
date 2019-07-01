@extends('layouts.modal',["modal_id"=> "companies-modal-create"])

@section('modal-title')
    {!! trans('manage_companies.create.label') !!}
@overwrite

@section('modal-content')



    {!! Form::open([
        'method'                => 'POST',
        'route'                 => ['admin::companies.ajax.store'],
        'role'                  => 'form' ,
        'id'                    => 'create_company_form',
        'class'                 => 'row',
        'v-on:submit.prevent'   => 'post'
    ]) !!}

        <div class="input-field col s12">
            {!! Form::label("name", 'Name:', ['class' => 'input-label']) !!}
            {!! Form::text("name", null, [
                'class'       => 'validate',
                'placeholder' => "",
                'required'    => 'required',
                'form'        => 'create_company_form'
            ]) !!}
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit(trans('manage_companies.create.save'), [
                    'class' => 'btn waves-effect waves-light  ',
                    'form'  => 'create_company_form'
                ]) !!}
            </div>
        </div>

    {!!Form::close()!!}

@overwrite
