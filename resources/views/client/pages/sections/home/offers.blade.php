<section data-scroll-index="about">
	<div class="grid__row offers__row">
		@include('client.general._menu')
		<div class="grid__container offers">
			{{-- <div class="offers__title">
				Quick-turn layout offers you
			</div>
			<div class="offers__subtitle">
				Design and engeineering software
			</div> --}}
			<div class="offers__list-container">
					@foreach ($section->components as $component)
						@unless (empty($component->title) )
						<div class="offers__list">
							<img class="offers__list-bullet" src="{{asset('images/PB-bullet.png')}}" alt="">
							<div class="offers__list-item">
								{!!$component->title!!}
							</div>
						</div>
						@endunless
					@endforeach
			</div>
		</div>
	</div>
</section>
