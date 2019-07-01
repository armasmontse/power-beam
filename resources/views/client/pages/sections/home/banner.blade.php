<section name="home">
	@unless (empty($section->components[0]->excerpt))
		<a href="{!!$section->components[0]->link_url!!}"
		@if ($section->components[0]->link_tblank)
			target="_blank"
		@else
			target=""
		@endif>
			<div class="grid__row ">
				{{-- <div class="grid__container grid__container--no-pad banner" > --}}
					<img class="banner__image" src="{{asset('images/PB-negro1.png')}}" alt="">
					<div class="banner__container banner">
						<div class="banner__paragraph">
							{!!$section->components[0]->excerpt!!}
						</div>
					</div>
					<img class="banner__image banner__image--right" src="{{asset('images/PB-negro2.png')}}" alt="">
				{{-- </div> --}}

			</div>
		</a>
	@endunless
</section>
