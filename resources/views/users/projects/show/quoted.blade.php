{{-- STEP 3	 --}}
<div class="card projects__card-min">
	
	<div class="card-content projects__card-content">
        
        <h4 class="fz-20 black-text projects__sbttl--step">We have quoted your project</h4>
        
        <p class="fz-16 projects__text">Here you will see more details about your quote.</p>

		<h4 class="fz-20 RobMedium projects__payment golden">
			<strong>Amount:</strong> {{ $quote->formated_amount }}
		</h4>

        <a href="{{ $quote->file->url }}" target="_blank">
	        <div class="center projects__card-center">
				<i class="material-icons">file_download</i>
				<p class="black-text">
					{{ $quote->file->name }}<br>
					{{ strtoupper($quote->created_at->format('d/m/Y, h:i a')) }}
				</p>
			</div>
        </a>

        <div style="display: flex; justify-content: center;">
	        <form action="{{ route('user::projects.quotes.accept', ['user' => $project->user, 'user_project' => $project, 'quote' => $quote]) }}" method="POST" style="margin: 0 10px;">
	        	{{ csrf_field() }}
				{{ method_field('PATCH') }}
	        	<input class="btn" style="width: auto;" type="submit" value="Accept">
	        </form>
	        <button class="btn" data-target="projects-modal-reject-quote">Reject</button>
        </div>

	</div>
</div>

        
