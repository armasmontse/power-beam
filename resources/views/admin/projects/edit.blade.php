@extends('layouts.admin')

@section('title')
    {!! trans('manage_projects.edit.label') !!}: {{ $project->name }}
@endsection

@section('h1')
    {!! trans('manage_projects.edit.label') !!}: {{ $project->name }}
@endsection

@section('action')
	<a href="{{ route('admin::projects.show', ['admin_project' => $project->id]) }}" class="btn-floating btn-icon">
	    <i class="material-icons waves-effect waves-light">remove_red_eye</i>
	</a>
@endsection

@section('content')

    <div class="col s10 offset-s1">
		
		<div class="row">
			<div class="col s12">

				<h5>Project manager:<small> {{ !is_null($project->manager) ? $project->manager->full_name : 'No project manager assigned yet.' }}</small></h5>

				<form action="{{ route('admin::projects.take', $project->id) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<div>
						<label for="manager">
							Select or update the manager of this project.
						</label>
						<select name="manager_id" id="manager">
							@foreach($managers as $manager)
								<option value="{{ $manager->id }}" @if(!is_null($project->manager_id)) {{ $project->manager_id == $manager->id ? 'selected' : '' }} @else {{ $user->id == $manager->id ? 'selected' : '' }} @endif>{{ $manager->full_name }} @if($project->manager_id == $manager->id) (current manager) @endif</option>
							@endforeach
						</select>
					</div>
					<br>
					<button class="btn" type="submit">
						Select manager
					</button>
				</form>
			</div>
		</div>
		
		<div class="row">
			<div class="col s12">
				<div class="divider"></div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">

				<h5>Project status:<small> {{ $project->status->label }}</small></h5>

				{{-- Si no es new, revisamos si tiene project manager. --}}
				@if(!is_null($project->manager))

					@if($project->status->slug == 'quoting')
						<h5>Quotes</h5>

						<form id="quoteFile_form" action="{{ route('admin::projects.quoteFile', ['projects_admin' => $project->id]) }}" method="POST" enctype="multipart/form-data">

							{{ csrf_field() }}

							<div class="form-group">
								<label>Amount must be in USD</label>
								<div style="display: flex; align-items: center;">
									<div style="margin: 20px 10px; margin-top: 0;">$</div>
									<input type="text" name="amount" value="{{ old('amount') }}" min='1' placeholder="00.00">
								</div>
							</div>
							<div class="form-group">
								<label>Upload a file: </label>
								<input id="file_input" type="file" name="quoteFile" form="quoteFile_form">
							</div>
							<br>
							<i class="btn waves-effect waves-light waves-input-wrapper">
								<input type="submit" value="Save Quote" class="waves-effect waves-light">
							</i>

						</form>

					@elseif($project->status->slug == 'quoted')

						<p>Wating for the user to accept the quote.</p>

					@elseif($project->status->slug == 'info')

						<p>Pending Information.</p>

					@elseif($project->status->slug == 'reviewing')

						{{-- Botón para avanzar, es un POST --}}

					@elseif($project->status->slug == 'pending-payment')

						<p>Wating for the user to make payment.</p>

					@elseif($project->status->slug == 'footprints')

						{{-- Botón para avanzar, es un POST --}}

					@elseif($project->status->slug == 'placement')

						{{-- Aqui se suben archivos para que el usuario los vea --}}
						<form id="placementFile_form" action="{{ route('admin::projects.placementFile', ['projects_admin' => $project->id]) }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Upload a file: </label>
								<input id="file_input" type="file" name="placementFile" form="placementFile_form">
							</div>
							<br>
							<i class="btn waves-effect waves-light waves-input-wrapper">
								<input type="submit" value="Save placement" class="waves-effect waves-light">
							</i>
						</form>

					@elseif($project->status->slug == 'pending-approval')

						<p>Waiting for user to approve the files.</p>

					@elseif($project->status->slug == 'routing')

						{{-- Botón para avanzar, es un POST --}}

					@elseif($project->status->slug == 'generating-output-files')

						{{-- Suben archivos para la entrega final. --}}
						<form id="outputFile_form" action="{{ route('admin::projects.outputFile', ['projects_admin' => $project->id]) }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Upload a file: </label>
								<input id="outputFile" type="file" name="outputFile" form="outputFile_form">
							</div>

							<i class="btn waves-effect waves-light waves-input-wrapper">
								<input type="submit" value="Save output files" class="waves-effect waves-light">
							</i>
						</form>

					@elseif($project->status->slug == 'delivered')

						{{-- Mostramos los archivos que se subieron para que el manager pueda descargarlos. --}}
						<p>Download all available files of this project <a class="link" href="{{ route('admin::projects.downloadFiles', ['admin_project' => $project->id]) }}">here</a>.</p>

					@endif

					@if($project->status_id === 5 | $project->status_id === 7 | $project->status_id === 10)
						<p>The current status needs offline actions, click the button below when all offline actions are complete and send project to next status.</p> <br>
						<form action="{{ route('admin::projects.next', $project->id) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<i class="btn waves-effect waves-light waves-input-wrapper">
								<input type="submit" value="Next status" class="waves-effect waves-light">
							</i>
						</form>
					@endif

					<div class="divider"></div>

					{{-- Mostramos las notas --}}
					<div class="row">
						<div class="col m12 l8 offset-l2">
							<div class="row">
								<div class="col s12">
									<h5>Notes</h5>
									<form id='addNote_form' action="{{ route('admin::projects.addNote', ['projects_admin' => $project->id]) }}" method="POST" role='form'>
										{{ csrf_field() }}
										<label for="note">Add notes to the project log.</label>
										<textarea id="note" name="note" type="text" rows="4" cols="50"></textarea>
										<div class="s12 input-field">
											<i class="btn waves-effect waves-light waves-input-wrapper pull-right" style="">
												<input type="submit" value="Save note" class="waves-effect waves-light">
											</i>
										</div>
									</form>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<ul class="collection">
										@forelse ($project->notes as $note)
											<li class="collection-item">
												<span class="title">
													@if(!is_null($note->user))<strong>{{ $user->full_name }}</strong> at @endif {{ $note->created_at->format('d/m/Y, h:m A') }}
												</span>
												<p>{{ $note->message }}</p>
											</li>
										@empty
											<li class="collection-item">
												This project does not have any notes yet.
											</li>
										@endforelse
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="divider"></div>

					{{-- Notificar algún error, solo si es menor a footprints el status. --}}
					@if($project->status_id < 7)
						<div class="grid__row">
							<div class="grid__container">
								<div class="row">
									<h5>Restart project</h5>
									<label>Restarting the project user entered information will be deleted. Enter the message that will be shown to the user.</label>
								</div>
								<div class="row">
									<form id='error_form' action="{{ route('admin::projects.error', ['projects_admin' => $project->id]) }}" method="POST" role='form'>
										{{ csrf_field() }}
										{{-- {!! Form::textarea('name',null,['class'=>'form-control', 'rows' => 4, 'cols' => 50]) !!} --}}
										<textarea id='error' name='error' type="text" rows="4" cols="50"></textarea>
										<i class="btn waves-effect waves-light waves-input-wrapper" style="">
											<input type="submit" value="Send error and restart" class="waves-effect waves-light">
										</i>
									</form>
								</div>
							</div>
						</div>
					@endif

				@endif
			</div>
		</div>

	</div>

@endsection
