<section id="reviews" data-scroll-index="reviews">
	@unless ($section->components->isEmpty())
		<div class="home-slider" id="home__swiper">
			<!-- Slider main container -->
			<div class="home-slider__container"  style="background-image: url({{ asset('images/PB-cita.png')}})">
			    <!-- Additional required wrapper -->
			    <div class="home-slider__wrapper">
			        <!-- Slides -->
					@foreach ($section->components as $component)

						@unless (empty($component->content))
							<div class="home-slider__slide">
								<div class="home-slider__paragraph grid__container ">
									<div class="home-slider__content grid__col-1-4">
										{!! $component->content !!}
									</div>
									<div class="home-slider__title grid__col-1-4">
										{{$component->title}}
									</div>
									<div class="home-slider__subtitle grid__col-1-4">
										{{$component->subtitle}}
									</div>
								</div>

							</div>
						@endunless

					@endforeach

			    </div>
			    <!-- If we need pagination -->
			    <div class="home-slider__pagination"></div>
			</div>

		</div>
	@endunless
</section>
