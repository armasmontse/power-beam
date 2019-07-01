import SmoothParallax from 'smooth-parallax'
import animateOnScroll from 'cltvo-animate-on-scroll'
import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';
import {alertsController} from './alerts-controller';
import {homeSwiperController} from './home-swiper-controller';
import {alerts} from './alerts';
import {fixMenu, menuMobile} from './theme-helpers'
import { mainVue } from './vue/main-vue'
import { registerVue } from './vue/main/register'

const splashIconsAnimations =
	[0,1,2,3,4,5].map(n =>
		['#icon-'+n, animateOnScroll, undefined, [$, 300, 'show', '.animatable_JS', '#icon-'+n]])


menuMobile('#menu-mobil', '.menu-mobil-toggler_JS')
w.on('load', () => {
	ifElementExistsThenLaunch([
		['#alert__container', alertsController, 'init', []],
		['#home__swiper',homeSwiperController, 'init', []],
		['#splash__background', SmoothParallax, 'init', [{ basePercentageOn: 'pageScroll' }]],
		['#menu-main', fixMenu, undefined, ['#menu-main', '#micro-menu']],
		['#menu-mobil', menuMobile, undefined, ['#menu-mobil', '.menu-mobil-toggler_JS']],
		['#register-vue', mainVue, undefined, [registerVue, {}]],
	]
	.concat(splashIconsAnimations));
	alerts;
});


//cosas relacionadas únicamente con la version de desarrollo
if (process.env.NODE_ENV ==='webpack') { window.CLTVO_ENV = 'webpack'} //corre en modo webpack, necesario para hacer HMR
if (module.hot) { module.hot.accept(); }//permite hacer Hot Module Replacement





$(document).ready(function() {

	$('select').material_select();

	$('#newCard').change(function() {
	    $('#newCard-add').toggle();
	});
	$('#high_speed-yes').change(function() {
	    $('#high_speed-add').toggle();
	});
	$('#interface_design-yes').change(function() {
	    $('#interface_design-add').toggle();
	});
	$('#card').change(function() {
	    $('#card-add').toggle();
	});
});
