{{-- Si el status es new ocultamos todo y mostramos el formulario de primeros pasos. --}}
@if ($project->status->group->slug == 'quick-turn')
	
	<p class="projects__navbar-label projects__navbar-label--red">Quick turn</p>

	<ul class="projects__navbar-label projects__navbar-list">
		{{-- Se hace foreach sobre los steps porque puedes cambiar sin modificar el estatus. --}}
		@foreach ($project->status->steps as $step)
			<li>
				@if ($project->completedStep($step))
					<i class="projects__navbar-icon material-icons">check</i>
				@endif
				@if ($step->slug != 'name')
					<a href="{{ route('user::projects.step', ['user' => $project->user, 'user_project' => $project, 'step' => $step->slug]) }}" class="projects__navbar-btn projects__navbar-item--other-mt btn transparent" @if (request()->route('step') == $step->slug) style="color: #d9534f;" @endif>
						{{ $step->id }}. {{ $step->title }}
					</a>
				@else
					<span class="projects__navbar-btn projects__navbar-item--other-mt btn transparent">{{ $step->id }}. {{ $step->title }}</span>
				@endif
			</li>
		@endforeach
		@if ($project->completedAllSteps()) 
			<form action="{{ route('user::projects.quote', ['user' => $project->user, 'user_project' => $project, 'step' => $step->slug]) }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<input type="submit" class="btn projects__navbar-btnGold" value="Quote my project">
			</form>
		@else
			<input type="submit" class="btn projects__navbar-btnGold" value="Quote my project" disabled>
		@endif
		
	</ul>

@else
		
	{{-- NEW PROJECT --}}
	<p class="projects__navbar-label projects__navbar-label--black">{{ $project->name }}</p>
	
	<ul class="projects__navbar-label projects__navbar-list">
		<li>
			<a href="{{ route('user::projects.info', ['user' => $project->user, 'user_project' => $project]) }}" class="projects__navbar-btn projects__navbar-item--projectNew btn transparent" @if (is_page('user::projects.info')) style="color: #d9534f;" @endif>
				Project info
			</a>
		</li>
		<li>
			<a href="{{ route('user::projects.log', ['user' => $project->user, 'user_project' => $project]) }}" class="projects__navbar-btn projects__navbar-item--projectNew btn transparent" @if (is_page('user::projects.log')) style="color: #d9534f;" @endif>
				Project log
			</a>
		</li>
		<li>
			<a href="{{ route('user::projects.show', ['user' => $project->user, 'user_project' => $project]) }}" class="projects__navbar-btn projects__navbar-item--projectNew btn transparent" style="margin-bottom: 15px; @if(is_page('user::projects.show')) color: #d9534f !important; @endif">
				{{ $project->status->group->title }}
			</a>
			@if ($project->status->group->slug == 'production' && is_page('user::projects.show'))
				
				<ol class="projects__navbar-label projects__navbar-list">
					@foreach ($project->status->group->statuses() as $status)
						<li class="projects__navbar-btn projects__navbar-item--production btn transparent" @if (is_page('user::projects.show') && $project->status->slug == $status->slug) style="color: #d9534f !important;" @endif>
							{{ $loop->iteration }}. {{ $status->label }}
						</li>
					@endforeach
				</ol>
				
			@endif
		</li>
	</ul>

@endif