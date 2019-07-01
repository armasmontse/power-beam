import {ifElementExistsThenLaunch} from './functions/dom';
import {alertsController} from './alerts-controller';
import {w} from './cltvo/constants.js';
import axios from 'axios';
//Vue
import {mainVue} from './vue/main-vue';
import {usersVue} from './vue/main/users';
import {projectsVue} from './vue/main/projects';

window.axios = axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {
	projects,
	projectsModalCreate,
	projectsModalEdit,
	projectsModalRejectQuote
} from './vue/components/simple-cruds-users';

import './vue/components/file-uploader';

w.on('load', () => {

	ifElementExistsThenLaunch([
		['#users-vue', mainVue, undefined, [usersVue, {
			projects,
			projectsModalCreate,
			projectsModalEdit,
		}]],
		['#projects-vue', mainVue, undefined, [projectsVue, {
			projects,
			projectsModalCreate,
			projectsModalEdit,
			projectsModalRejectQuote
		}]],
		['#alert__container', alertsController, 'init', []],
	]);
	$(".dropdown-button").dropdown();
});

//cosas relacionadas únicamente con la version de desarrollo
if (process.env.NODE_ENV ==='webpack') { window.CLTVO_ENV = 'webpack'} //corre en modo webpack, necesario para hacer HMR
if (module.hot) { module.hot.accept(); }//permite hacer Hot Module Replacement
