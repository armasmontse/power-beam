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

// projects
export const projectsModalCreate = simpleModalCrud('#projects-modal-create-template', {});
export const projectsModalEdit = simpleModalCrud('#projects-modal-edit-template',{props:['edit-index']});
export const projects = simpleCrud('#projects-template', {
	data: {
        filters: {
			project_name: {
				description: 'Project Name',
				filters: [isPath(['name',])]
			},
			code: {
				description: 'Code',
				filters: [isPath(['code'])]
			},
			status: {
				description: 'Status',
				filters: [isPath(['status'])]
			},

		},
	},
	mixins: [listFilters],
	methods: {openModal},
	components:{projectsModalCreate, projectsModalEdit }
});

export const projectsModalRejectQuote = simpleModalCrud('#projects-modal-reject-quote-template', {});
