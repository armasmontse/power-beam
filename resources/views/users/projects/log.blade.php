@extends('layouts.user')

@section('content')
    
    <div class="container-user container-height">
		<div class="row row-height">
    		<div class="col s12 m3 l2 projects__navbar">
    			@include('users.projects._nav')
    		</div>
      		<div class="col s12 m9 l10">
			    <div class="col l10 offset-l1">
					<section>
						<h2 class="projects__ttl">{{ trans('Project log') }}</h2>
		                
		                <p class="projects__text">
		                	{{ trans('Here you can find a detailed description of your quote, it will include a resume of the requests of the project as well as important information you may find useful.') }} <br><br><br>
		                </p>
		            	
		            	<ul class="collapsible projects__collapse" data-collapsible="accordion">
							@foreach ($history as $item)
								<li>
									@if (get_class($item) == 'App\Models\Projects\Note')
										<div class="collapsible-header projects__collapse-header">
											<div class="col l3">
												<i class="material-icons">assignment</i>
												<span class="projects__collapse-header--date">{{ $item->created_at->format('d/m/Y, h:m A') }}</span>
											</div>
											<div class="col l9">
												<span class="projects__collapse-header--title">{{ trans('Note') }}</span>
											</div>
										</div>
										<div class="collapsible-body projects__collapse-body">
											<p class="projects__collapse-body--text" style="padding: 0;">
												@if(!is_null($item->user)) <strong>{{ $item->user->full_name }}</strong><br> @endif {{ $item->message }}
											</p>
										</div>
									@elseif(get_class($item) == 'App\Models\Projects\Quote')
										<div class="collapsible-header projects__collapse-header">
											<div class="col l3">
												@if (is_null($item->decision))
													<i class="material-icons">label</i>
												@else
													@if ($item->decision)
														<i class="material-icons">check_circle</i>
													@else
														<i class="material-icons">highlight_off</i>
													@endif
												@endif
												<span class="projects__collapse-header--date">{{ $item->created_at->format('d/m/Y, h:m A') }}</span>
											</div>
											<div class="col l9">
												<span class="projects__collapse-header--title">{{ trans('Quote') }}</span>
											</div>
										</div>
										<div class="collapsible-body projects__collapse-body">
											<a href="{{ $item->file->url }}" target="_blank" class="flex waves-effect waves-light btn projects__collapse-body--btnRed">
												{{ trans('Download quote') }} <i class="padd-left-10 material-icons">file_download</i>
											</a>
											@if (is_null($item->decision))
												<span class="projects__collapse-body--txt">{{ trans('Approval of quotation to continue.') }}</span>
												<div style="display: flex;">
											        <form action="{{ route('user::projects.quotes.accept', ['user' => $project->user, 'user_project' => $project, 'quote' => $item]) }}" method="POST" style="margin: 0 10px;">
											        	{{ csrf_field() }}
														{{ method_field('PATCH') }}
											        	<input class="btn" style="width: auto;" type="submit" value="Accept">
											        </form>
											        <a href="{{ $project->show_url }}" class="btn" style="width: auto; background-color: #DC3847;">{{ trans('Reject') }}</a>
										        </div>
											@else
												@if ($item->decision)
													<span class="projects__collapse-body--approved">{{ trans('Quote approved') }}</span>
												@else
													<span class="projects__collapse-body--disapproved">{{ trans('Quote disapproved') }}</span>
												@endif
											@endif
										</div>
									@endif
								</li>
							@endforeach
						</ul>
					</section>
				</div>
			</div>
		</div>
	</div>

@endsection

