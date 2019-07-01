import R from 'ramda';
import Vue from 'vue';
import {simpleCrud, simpleCrudWithImage, simpleModalCrud} from '../factories/simple-crud-component-makers.js';
import {multiSelect} from '../components/multi-select';
import {gMap} from '../components/g-map';
import {numberFilters} from '../mixins/number-filters';
import {sortable} from '../mixins/sortable';
import {multilistSortable} from '../mixins/multilist-sortable';
import {sortableListByClick, sortableOnClickCbs} from '../mixins/sortable-list-by-click';
import {listFilters, isPath, isPathInObjArray, isStringArray} from '../mixins/list-filters';
import {mexicoStatesAndMunicipalities} from '../mixins/mexico-states-and-municipalities';
import {sortByNestedProp, toArray, objTextFilter, tapLog, nonCyclingMoveInArray} from '../../functions/pure';
import {preSelectOption} from '../../functions/dom';
import {makePost, openModal, openModalFromSimpleImageCrud, postWithMaterialNote, checkboxesMethods} from './helpers/simple-crud-helpers';

// usuarios
export const rolesMultiSelect = multiSelect('#roles-multi-select-template');

let userFilters = {
	data: {
		filters: {
			name: {
				description: 'Name',
				filters: [isPath(['full_name'])]
			},
			email: {
				description: 'Email',
				filters: [isPath(['email'])]
			},
			role: {
				description: 'Rol',
				filter: [isPathInObjArray(['roles'], ['label'])]
			},
		}
	},
	mixins: [listFilters],
};
// users index
export const users = simpleCrud('#users-template', userFilters);

// users trash
export const usersTrash = simpleCrud('#users-trash-template', userFilters);

//empresas
export const companiesModalCreate = simpleModalCrud('#companies-modal-create-template');
export const companiesModalEdit = simpleModalCrud('#companies-modal-edit-template',{props:['edit-index']});
export const companies = simpleCrud('#companies-template', {
	data: {
		filters: {
			name: {
				description: 'Name',
				filters: [isPath(['name'])]
			},
		}
	},
	mixins: [listFilters],
	methods: {openModal},
	components:{companiesModalCreate, companiesModalEdit }
});

let projectFilters = {
	data: {
		filters: {
			name: {
				description: 'Name',
				filters: [isPath(['name'])]
			},
			code: {
				description: 'Code',
				filters: [isPath(['code'])]
			},
			user: {
				description: 'User',
				filters: [isPath(['user', 'full_name'])]
			},
			manager: {
				description: 'Manager',
				filters: [isPath(['manager', 'full_name'])]
			},
			status: {
				description: 'Status',
				filters: [isPath(['status', 'label'])]
			},
			updated: {
				description: 'Updated at',
				filters: [isPath(['updated_at'])]
			},
		}
	},
	mixins: [listFilters],
};
// users index
export const projects = simpleCrud('#projects-template', projectFilters);
