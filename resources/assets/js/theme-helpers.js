import { w } from './cltvo/constants.js';

export const fixMenu = (menu_selector, micro_menu_selector) => {
	let menu = $(menu_selector)
	let menu_pos = menu.offset().top
	let menu_height = menu.height()
	let top_offset = $(micro_menu_selector).height()
	let w_height = w.height()

	menu.is_fixed = false

	w.on('scroll', () => {
		if (menu_pos <= w.scrollTop() + top_offset && !menu.is_fixed) {
			menu.is_fixed = true
			menu.css({
				position: 'fixed',
				top: top_offset,
				left: 0,
				zIndex: 99
			})
		} else if (menu_pos >= w.scrollTop() + top_offset && menu.is_fixed) {
			menu.is_fixed = false
			menu.removeAttr('style')
		}
	})
}

export const menuMobile = (menu_mobile_container, toggler_selector) => {
	let menu = $(menu_mobile_container)
	let button = $(toggler_selector)
	let $body = $('body')
	let w_width = w.width()

	let $img_closer = $('#img-JS-close')
	let $img_hamburger = $('#img-JS-hamburger')

	let $menu_mobile = $('.header__menu-mobil-link')

	let close = () => {
		menu.slideUp()
		menu.is_open = false
		$body.removeClass('noScroll_JS')
	}

	menu.is_open = false

	button.on('click', () => {
		if(menu.is_open === false) {
			menu.slideDown()
			menu.is_open = true
			$body.addClass('noScroll_JS')

			$img_closer.addClass('show-img')
			$img_hamburger.addClass('none-img')	

		} else {
			close()
			
			$img_closer.removeClass('show-img')
			$img_hamburger.removeClass('none-img')
		}
	}) 

	w.on('resize', () => {
		let new_width = w.width()
		if (w_width !== new_width) {
			close()
			w_width = new_width
		}
	})

	$menu_mobile.on('click', () => {
		close()

		$img_closer.removeClass('show-img')
		$img_hamburger.removeClass('none-img')
		$img_hamburger.addClass('show-img')
	})
}