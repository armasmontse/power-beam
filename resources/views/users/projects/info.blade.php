@extends('layouts.user')

@section('content')
    
    <div class="container-user">
		<div class="row">
    		<div class="col s12 m3 l2 projects__navbar">
    			@include('users.projects._nav')
    		</div>
      		<div class="col s12 m9 l10">
			    <div class="col l10 offset-l1">

			    	{{-- PROJECTS --}}
					<section>
						
						<h2 class="projects__ttl">{{ trans('Project info') }}</h2>
						
		                <p class="projects__sbttl">
		                	{{ $project->name }} | {{ trans('Code') }}: <span style="text-transform: uppercase;">{{ $project->code }}</span>
		                </p>
		                
		                <p class="projects__text">{{ trans('We have received your information and are working to quote it. When your quote is ready, we will email you to check the Project Log. It will give you the quote and additional information you will need to proceed.') }}</p>
						
						@if (!is_null($project->manager))
							<div class="projects__content">
								<div class="card horizontal projects__cardHorizontal">
									<div class="card-image projects__cardHorizontal-image">
										<img src="{{ $project->manager->thumbnail_image->url }}">
									</div>
									<div class="card-stacked">
										<div class="card-content projects__cardHorizontal-content">
											<span class="card-title projects__cardHorizontal-content--title">{{ $project->manager->full_name }}</span>
											<span class="projects__cardHorizontal-content--sbttl">{{ trans('Project Manager') }}</span>
											<p class="projects__cardHorizontal-content--txt">{{ trans('I am responsible for your project. If you have received your quote but you need to contact me, please email me at my address below. If you prefer to talk, suggest a time for a call, and don’t forget to include your phone number.') }}</p>
										</div>
										<div class="card-action projects__cardHorizontal-content--cardAction">
											<a href="mailto:{{ $project->manager->email }}">{{ $project->manager->email }}</a>
										</div>
									</div>
								</div>
							</div>
						@else
							<p class="projects__text">{{ trans('No dont have already a project manager assigned to your project.') }}</p>
						@endif

					</section>

				</div>
			</div>
		</div>
	</div>

@endsection