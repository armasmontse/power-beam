{{-- STEP 1 --}}
<h2 class="projects__ttl">{{ $project->name }}</h2>
{{-- El texto de abajo cambiara los pasos decuerdo al step en el que se encuentre --}}
<p class="projects__sbttl">
	Start your new quick turn layout in just 4 steps. <br>
	We do not need your final project files to quote your project, but we need an accurate BOM 
	and other information about the design.  Inaccurate information will make the process more 
	expensive and slower.
</p>

@if ($project->completedAllSteps())
	<p class="projects__sbttl">
		Congrats! You have completed the neccesary steps to quote your project <br>
		Click the black button on the left of your screen and you are ready.
	</p>
@endif