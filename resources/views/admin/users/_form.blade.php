{!! Form::open([
    'method'             => $form_method,
    'route'              => $form_route,
    'role'               => 'form' ,
    'id'                 => $form_id,
    'class'              => '',
    ]) !!}
    <div class="row">

        <div class="input-field col s5  offset-s1">
            {!! Form::label('first_name', trans('manage_users.create.form.first_name.label'), [
                'class' => 'active',
            ]) !!}
            {!! Form::text('first_name', $user_edit->first_name, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => $form_id,
                'placeholder'   =>  trans('manage_users.create.form.first_name.placeholder')
            ]) !!}
        </div>

        <div class=" input-field col s5">
            {!! Form::label('last_name',trans('manage_users.create.form.last_name.label'), [
                'class' => 'active',
                ]) !!}
            {!! Form::text('last_name', $user_edit->last_name, [
                'class'         => 'validate',
                'required'      => 'required',
                'form'          => $form_id,
                'placeholder'   => trans('manage_users.create.form.last_name.placeholder')
            ]) !!}
        </div>

       	<div class="row">
       		<div class="input-field col s5 offset-s1">
       		    {!! Form::label('email', trans('manage_users.create.form.email.label'), [
       		        'class' => '',
       		        ]) !!}
       		    {!! Form::email('email', $user_edit->email, [
       		        'class'       => 'validate',
       		        'required'    => 'required',
       		        'form'        => $form_id,
       		        'placeholder' => trans('manage_users.create.form.email.placeholder')
       		    ]) !!}
       		</div>
       		<div class=" input-field col s5">
       		    {!! Form::label('phone',trans('manage_users.create.form.phone.label'), [
       		        'class' => 'active',
       		        ]) !!}
       		    {!! Form::text('phone', $user_edit->phone, [
       		        'class'         => 'validate',
       		        'required'      => 'required',
       		        'form'          => $form_id,
       		        'placeholder'   => trans('manage_users.create.form.phone.placeholder')
       		    ]) !!}
       		</div>
       	</div>

       	<div class="row" style="margin-bottom: 10px;">
       		<div class=" input-field col s5 offset-s1">
       		    {!! Form::label('job_position',trans('manage_users.create.form.job_position.label'), [
       		        'class' => 'active',
       		        ]) !!}
       		    {!! Form::text('job_position', $user_edit->job_position, [
       		        'class'         => 'validate',
       		        'required'      => 'required',
       		        'form'          => $form_id,
       		        'placeholder'   => trans('manage_users.create.form.job_position.placeholder')
       		    ]) !!}
       		</div>
       		<div class="col s5">
       			<label for="company">Company</label>
       			<select name="company" id="company" required>
       				<option value="">Select company</option>
       				@foreach ($companies as $company)
       					<option value="{{ $company->id }}" @if ($user_edit->company_id == $company->id) selected="" @endif>{{ $company->name }}</option>
       				@endforeach
       			</select>
       		</div>
       	</div>

        <div class="col s10  offset-s1 ">
            <div class="pull-right">
                {!! Form::submit(trans('manage_users.create.form.save'), [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => $form_id
                ]) !!}
            </div>
        </div>

    </div>
{!! Form::close() !!}
