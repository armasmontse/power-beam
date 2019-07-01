{{-- Title production --}}
@include('users.projects.show._prueba_production')

{{-- STEP 9	 --}}
<div class="card projects__card">
	<div class="card-content projects__card-content">
        <h4 class="fz-20 black-text projects__sbttl--step">Step 6. Authorization</h4>
        <p class="fz-16 projects__text">Is the Placement okay. Is it ready for routing? </p>
        
        <a href="{{ $placement->url }}" target="_blank">
	        <div class="center projects__card-center">
				<i class="material-icons">file_download</i>
				<p class="black-text">
					{{ $placement->name }}<br>
					{{ strtoupper($placement->pivot->created_at->format('d/m/Y, h:i a')) }}
				</p>
			</div>
        </a>

		<form class="center" action="{{ route('user::projects.route', ['user' => $user, 'user_project' => $project]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<button type="submit" class="waves-effect waves-light btn">YES, The Placement is Correct. Please begin routing.</button>
		</form>

		<br><br>

		<form class="center" action="{{ route('user::projects.dontRoute', ['user' => $user, 'user_project' => $project]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<button type="submit" class="btn-disable fz-14 RobMedium black-text">No, i will contact</button>
		</form>

	</div>
</div>