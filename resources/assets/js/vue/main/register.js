import R from 'ramda';
import { objTextFilter, orderAscending } from '../../functions/pure'

import debounce from 'lodash.debounce'

export var registerVue = {
	ready() {
		let $company = $('#company')
		$company.on('focus', () => {
			this.companies_input_is_focused = true
		})
		$company.on('blur', debounce(() => {
			this.companies_input_is_focused = false
		}, 100))
	},
	data: {
		company_name: '',
			companies_input_is_focused: false
	},
	computed: {
		availableCompanyNames() {//para el autocompletado
			if (this.company_name === '') { return [] }
			return R.pipe(
				objTextFilter(['name'], this.company_name),
				R.map(R.prop('name')),
				orderAscending
			)(this.store.companies || [])
		},
		showCompanyAutocomplete() {
			//la única opción es la opción ya seleccionada
			if (this.availableCompanyNames.length === 1 && this.company_name === this.availableCompanyNames[0]) {
				return false
			}

			//hay opciones y el input está enfocado
			return this.availableCompanyNames.length > 0
				&& this.companies_input_is_focused === true
		}
	},
	methods: {
		selectCompanyName(name) {
			this.company_name = name
		}
	},
}

