@extends('layouts.user')

@section('content')

    @if(count($projects) === 0)
        <div class="container-user projects">
        	<div class="row">
    	        <div class="col s12 l10 offset-l1">
    				<div class="col s12 m12 l7">
                        <h2 class="projects__ttl">{{ trans('manage_projects.empty.title') }}</h2>
                        <p class="fz-20 projects__text">
                        	The project list keeps all your project data from multiple projects in one place.
    					</p>
                        <span data-target="projects-modal-create" >
                            <a class="right projects__link">{{ trans('manage_projects.empty.link') }}</a>
                        </span>
    					{{-- href="{{ route('user::projects.create', $user) }}" --}}
    				</div>
    	        </div>
    	    </div>
        </div>
    @else
        <div class="container-user projects">
        	<div class="row">
    	        <div class="col s12">
    	            <div class="col s12 l10 offset-l1">
    					<h2 class="projects__ttl">{{ trans('Projects') }}</h2>
    				</div>
    				<projects :list="store.projects.data"></projects>
    	        </div>
    	    </div>
        </div>
    @endif

@endsection

@section('vue_templates')

    <script type="x/templates" id="projects-template">
		<div class="">
	        @include('users.general._table-search')
			<div class="col s12 l12">
	            @include('users.projects.index._table')
	        </div>
		</div>
    </script>

@endsection

@section('vue_store')
    <script>
		 mainVueStore.projects = { data: {!! $projects !!} };
    </script>
@endsection
