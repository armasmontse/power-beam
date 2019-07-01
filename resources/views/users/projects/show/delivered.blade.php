{{-- STEP 12 --}}
<div class="card projects__card-min">
	<div class="card-content projects__card-content">
        <h4 class="fz-20 black-text projects__sbttl--step">Step 9. Delivery</h4>
        <p class="fz-16 projects__text">Your layout is complete.  Please download the design files and the fabrication files here.</p>
        <a href="{{ $output->url }}" target="_blank">
	        <div class="center projects__card-center">
				<i class="material-icons">file_download</i>
				<p class="black-text">
					{{ $output->name }}<br>
					{{ strtoupper($output->pivot->created_at->format('d/m/Y, h:i a')) }}
				</p>
			</div>
        </a>
	</div>
</div>