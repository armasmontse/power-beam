<section id="process" data-scroll-index="process">
	@unless ($section->components->isEmpty())
		<div class="grid__row">
			<div class="grid__container">
				<div class="icons__title">
					The process that simplifies your result
				</div>
				@foreach ($section->components as $key => $component)
					<div id="icon-{{$key}}" class="grid__col-1-6 icons__icon-container">
						<div class="icons__animation-container icons__animation-container--{{$key}} animatable_JS">	
							<div class="icons__number">
								{{	$key + 1 }}
							</div>

							<div class="icons__icon">
								<img src="{!!$component->thumbnail_image->url!!}" alt="">

							</div>

							<div class="icons__divisor"></div>

							<div class="icons__content">
								{!!$component->title!!}
							</div>
						</div>

					</div>
				@endforeach
			</div>
		</div>
	@endunless
</section>
