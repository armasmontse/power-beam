<div class="sidebar" id="admin-main-menu">

	<div class="sidebar-app">

		<div class="column">
			<a class="logo" href="{{ route("client::pages.index") }}" alt="{{ config( "app.name") }}">
				<img src="{{ asset('images/PB-logo-menu-admin.png') }}" alt="">
			</a>
		</div>

		<div class="column">
			<span class="title">{{ config( "app.name") }}</span>
		</div>

		<ul class="languages">
			@foreach ($languages as $language)
				<li>
					@if ($language->is_current)
						<span class="active">{{ $language->iso6391 }}</span>
					@else
						<a href="{{ $language->translate_url }}" class="">{{ $language->iso6391 }}</a>
					@endif
				</li>
			@endforeach
		</ul>

	</div>
	
	<div class="sidebar-user">

		<div class="column">

			<!-- Dropdown Trigger -->
			<a class="profile" href="{{ route('user::profile', $user->name) }}" href="#" data-activates="">
				<img src="{{ $user->thumbnail_image->url }}" alt="">
			</a>

			<a class="title dropdown-trigger" data-target="dropdown1" href="#">{{ $user->full_name }}</a>

			<!-- Dropdown Structure -->
			<ul class="profile-options" id="dropdown1">
				<li>
					<a href="{{ route('user::profile', $user->name) }}">My account</a>
				</li>
				<li>
					{!! Form::open(['method' => 'POST', 'route' => 'client::logout']) !!}
						{!! Form::submit(trans('admin.layout.sidebar.logout'), ['class' => 'logout']) !!}
					{!! Form::close() !!}
				</li>
			</ul>

		</div>

	</div>

	<div class="sidebar-menu">
		<div class="column">
			<ul class="menu">
				@foreach ($menu_items as $menu_item)
					@if (!$menu_item->sub_menu->isEmpty())
						<li class="{{ $menu_item->current ? 'active' : '' }}">
							<span>{{ $menu_item->label }}</span>
							<ul class="">
								@foreach ($menu_item->sub_menu as $sub_menu_item )
									<li>
										<a class="{{ is_page( $route_group_prefix.$sub_menu_item->name ) ? 'active' : '' }}" href="{{ route($route_group_prefix.$sub_menu_item->name) }}">{{ $sub_menu_item->label }}</a>
									</li>
								@endforeach
							</ul>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>

</div>