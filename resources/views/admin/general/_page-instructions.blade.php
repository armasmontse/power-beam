
<div class="col s12 l10 offset-l1">
	@unless (empty($title))
		<h3 class="instructions-title">{{ $title }}</h3>
	@endunless
	@unless (empty($instructions))
		<p class="instructions">
			{!! $instructions !!}
		</p>
	@endunless
	<br>
	<div class="divider no-margin"></div>
</div>
