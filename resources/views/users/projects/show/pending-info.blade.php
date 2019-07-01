@include('users.projects.show._prueba_production')

{{-- STEP 4 --}}
<div class="card projects__card clearfix">

	<div class="card-content projects__card-content">

        <h4 class="fz-20 black-text projects__sbttl--step">Step 1. Preliminary Info</h4>
        
        <p class="fz-16 projects__text">
        	To begin, please provide the info below. The information and files should be the final 
        	ones because we use them for quoting and to create the project.
        </p>

		{{-- Step 1.1: Geometry --}}
		@include('users.projects.show.pending-info.geometry')

		{{-- Step 1.2: Stackup --}}
		@include('users.projects.show.pending-info.stackup')

		{{-- Step 1.3: Routing --}}
		@include('users.projects.show.pending-info.routing')

		{{-- Step 1.4: High speed --}}
		@include('users.projects.show.pending-info.high-speed')

		{{-- Step 1.5 --}}
		@include('users.projects.show.pending-info.power-supply')

		{{-- Step 1.6 --}}
		@include('users.projects.show.pending-info.altium')

		<div id="next">

			<h4 class="fz-20 black-text projects__sbttl--step">Submit info</h4>

			<p class="clearfix mb-50 fz-16 projects__text">
				Before submitting, please review your info since you'll not be able to...
			</p>

			<form action="{{ route('user::projects.pendingInfo.store', ['user' => $project->user, 'user_project' => $project]) }}" method="POST">

				{{ csrf_field() }}
				{{ method_field('PATCH') }}
	
				<div class="projects__card-content--btn ">
					<input class="btn" style="background-color: #d9534f !important;" type="submit" value="Save and Continue" >
				</div>
	
			</form>

		</div>

	</div>
</div>
