<div class="grid__row break">
	@unless (empty($section->components[0]->link_url) )
		<a
		href="{!!$section->components[0]->link_url!!}" class="break__btn"
		@if ($section->components[0]->link_tblank)
			target="_blank"
		@else
			target=""
		@endif>
			{!!$section->components[0]->link_title!!}
		</a>
	@endunless
	<div class="grid__container grid__container--no-pad">
		<img class="break__img" src="{!!$section->components[0]->thumbnail_image->url!!}" alt="">
	</div>
</div>
