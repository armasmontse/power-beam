@include('client.general._micro_menu')

<header class="powerbeam-primary navbarUser">
	
	{{-- container-user --}}
	<nav class="">
		<div class="container">
			<div class="nav-row">
				{{-- brand-logo  --}}
				<a href="{{ url('/') }}" class="logo"> 
					<span class="title">Quick turn layout by</span>
					{{-- navbarUser__img --}}
					<img class="img" src="{{ asset('images/PB-logo-portada-white.svg')}} " alt="#">
				</a>
				
				<ul id="nav-mobile" class="right">
					<li>
						{{-- navbarUser__text --}}
						<a class="menu-link" href="{{ route('user::projects.index', $user) }}">Projects</a>
					</li>
					<li>
						<a class="menu-link dropdown-button" href="#!" data-activates="dropdown1">
							{{ $user->full_name }}
							<i class="material-icons right drop-down-icon">arrow_drop_down</i>
						</a>
					</li>
					<li>
						<span data-target="projects-modal-create" class="modal-trigger btn-floating btn-large halfway-fab waves-effect waves-light teal right">
							<i class="material-icons powerbeam-secondary">add</i>
						</span>
					</li>
				</ul>

			</div>
		</div>
	</nav>

	<!--  dropdown-->
	<ul id="dropdown1" class="dropdown-content">
		<li><a href="{{ $user->getHomeUrl()  }}">My account</a></li>
		<li>
			{!! Form::open(['method' => 'POST', 'route' => 'client::logout']) !!}
				{!! Form::submit(trans('admin.layout.sidebar.logout'), ['class' => 'dropdown__button--logout back-trans left-txt']) !!}
			{!! Form::close() !!}
		</li>
	</ul>

</header>
