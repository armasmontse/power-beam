@include('client.general.menu-mobil')
@include('client.general._micro_menu')

<div class="grid__row offers__row">
	@include('client.general._menu')
</div>

<div class="grid__row">
	<div class="grid__container">
		<div class="pages__ttl" >
			{!!$section->components[0]->title!!}
		</div>
		<div class="pages__text">
			{!!$section->components[0]->content!!}
		</div>
	</div>
</div>
