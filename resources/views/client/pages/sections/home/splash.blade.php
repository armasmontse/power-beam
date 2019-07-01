@include('client.general.menu-mobil')
{{-- @include('client.general._micro_menu') --}}
{{--  por razones de layout el menu-main está en client.pages.sections.offers  --}}
@unless ($section->components->isEmpty())
	<div class="grid__row" id="height_JS">
		<div id="splash__background" class="splash__background"
			style="background-image: url({!!$section->components[0]->thumbnail_image->url!!})"
			smooth-parallax=""
			end-movement="7"
			end-position-y="0.5"
			>

			<div class="">
				<div class="grid__col-1-4 splash splash--max">
					<img class="splash--max--img" src="{{asset('images/PB-portada.png')}}" alt="">
					<div class="splash__container">

						<div class="splash__content">
							{!!$section->components[0]->title!!}
						</div>
						<img  class="splash__logo" src="{{asset('images/PB-logo-portada.png')}}" alt="">

						@if (strlen($section->components[0]->link_url)>15)
							<a
							href="{!!$section->components[0]->link_url!!}" class="splash__button"
							@if ($section->components[0]->link_tblank)
								target="_blank"
							@else
								target=""
							@endif>
								{!!$section->components[0]->link_title!!}
							</a>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
@endunless
