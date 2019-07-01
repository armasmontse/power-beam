var _ = require('ramda');
// var Swiper = require('swiper');

export var homeSwiperController = function() {
	let modal_config = {
			dismissible: true, // Modal can be dismissed by clicking outside of the modal
			opacity: 0, // Opacity of modal background
			in_duration: 100, // Transition in duration
			out_duration: 300, // Transition out duration
			starting_top: 0, // Starting top style attribute
			ending_top: 0, // Ending top style attribute
			ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
			  $('body').css({overflow: ''})
			},
			complete: function() { } // Callback for Modal close
	};
	return {
		init() {
			let slider_prefix = 'home-slider',
				slider_slide_prefix = slider_prefix+'__slide',
				slider_pagination_prefix = slider_prefix+'__pagination',

				swiper_options = {
					containerModifierClass: 	slider_prefix+'__container--',
					wrapperClass: 				slider_prefix+'__wrapper',
					slideClass: 				slider_slide_prefix,
					slideActiveClass:			slider_slide_prefix + '--active',
					slideDuplicatedActiveClass:	slider_slide_prefix + '__duplicate--active',
					slideVisibleClass:			slider_slide_prefix + '--visible',
					slideDuplicateClass:		slider_slide_prefix + '--duplicate',
					slideNextClass:				slider_slide_prefix + '--next',
					slideDuplicatedNextClass:	slider_slide_prefix + '__-duplicate--next',
					slidePrevClass:				slider_slide_prefix + '--prev',
					slideDuplicatedPrevClass:	slider_slide_prefix + '__duplicate--prev',

					loop: true,
					pagination: {
						el: '.'+slider_pagination_prefix,
						bulletClass: slider_pagination_prefix+'__bullet',
						bulletActiveClass: slider_pagination_prefix+'__bullet--active'
					},
					autoplay: {
						delay: 3000,
					},
			    };

			var homeSwiper = new Swiper ('.'+slider_prefix+'__container', swiper_options);

		},


	}
}(jQuery);
