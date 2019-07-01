<section id="contact" data-scroll-index="contact">
	@unless ($section->components->isEmpty())
		<div class="grid__row">
			<div class="grid__container contact__no-padding">
				<div class="grid__col-1-4 contact">
					<div class="contact__title">
						Offices
					</div>
					<div class="contact__subtitle">
						If you have any questions:
					</div>
					<div class="contact__container">
						@foreach ($section->components as $component)
							<div class="contact__col-1-2">
								<div class="contact__office-name">
									{!!$component->title!!}
								</div>
								<div class="contact__address-contact">
									{!!$component->content!!}
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endunless
</section>
