import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';
import {alertsController} from './alerts-controller';
import {adminMainMenu} from './admin-main-menu';
import {mediaTriger}	from './media-triger';

//Vue
import {mainVue} from './vue/main-vue';
import {adminVue} from './vue/main/admin';
import {
		pages,
		pagesectionsModalCreate,
		pagesectionsModalEdit,
		pagesections,
		pagesectionsCheckbox,
		pagesectionsSort,
		sectionProtected,
		sectionMultipleUnlimited,
		sectionMultipleLimited,
		sectionMultipleFixed,
		componentForm,
		currentPageSections
	} from './vue/components/pages-simple-cruds';

import {
	rolesMultiSelect,
	users,
	usersTrash,

	companiesModalCreate,
	companiesModalEdit,
	companies,

	projects

} from './vue/components/simple-cruds';

import {mediaManager} from './vue/components/media-manager';
import './vue/components/multi-images';
import './vue/components/single-image';
import './vue/components/cltvo-v-editor';

w.on('load', () => {
	ifElementExistsThenLaunch([
		[],
		['#admin-vue', mainVue, undefined, [adminVue, {
			mediaManager,
			pages,
			pagesectionsModalCreate,
			pagesectionsModalEdit,
			pagesections,
			pagesectionsCheckbox,
			pagesectionsSort,
			sectionProtected,
			sectionMultipleUnlimited,
			sectionMultipleLimited,
			sectionMultipleFixed,
			componentForm,
			currentPageSections,
			rolesMultiSelect,
			users,
			usersTrash,

			companiesModalCreate,
			companiesModalEdit,
			companies,

			projects
		}]],
		['#alert__container', alertsController, 'init', []],
		['#admin-main-menu', adminMainMenu, undefined, [$,'.nav_JS','.label_JS','.tree_JS', 'label_active']],
		mediaTriger,
	]);
});

$(document).ready(function() {

	console.log('Hola, estás bien sabroso de tu micorriza');

	$('.open-sidebar').click(function() {
		console.log('Open');
		$('.header, .sidebar, .main').toggleClass('open')
	})

})



//cosas relacionadas únicamente con la version de desarrollo
if (process.env.NODE_ENV ==='webpack') { window.CLTVO_ENV = 'webpack'} //corre en modo webpack, necesario para hacer HMR
if (module.hot) { module.hot.accept(); }//permite hacer Hot Module Replacement
