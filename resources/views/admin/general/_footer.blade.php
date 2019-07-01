<footer class="page-footer footer">
    <div class="footer-copyright footer__copyright">
		<div class="footer__container">
			<a href="{{ url('/') }}">
				<img class="footer__logo" src="{{ asset('images/PB-logo-portada-white.svg') }}">
			</a>
			<span class="right" >
				{!! trans('admin.layout.development_by',["name" => '<a class="footer__link" href="http://www.elcultivo.mx/" target="_blank"> El Cultivo</a>']) !!}
			</span>
		</div>
    </div>
</footer>
