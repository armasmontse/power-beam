import Vue from 'vue';
import R from 'ramda';
import { fileUploaderCommunication } from '../mixins/file-uploader-mixin'
import { stripe } from '../mixins/stripe';
import { uppercaseFirst } from '../../functions/pure'
const tap = (...x) => { console.log.apply(null, x); return x[x.length - 1] }

export const projectsVue = {
	el: '#projects-vue',
	mixins: [fileUploaderCommunication, stripe],
	data: {
		has_cpu: null,
		has_memory_interfaces: null,
		has_impedance_traces: null,
		selectedCard: '-1',
		checkout_form: 'checkout_form',
		payment_method: '',
		optional_fields: {
			data: '',
			stackup: '',
			routing: '',
		}
	},
	computed: {
		newCreditCard() {
			return this.selectedCard === '-1'
		},
	},
	methods: {
		makeCheckout() {
			if (this.payment_method === 'stripe' && this.newCreditCard) {
				this.stripePost()
			}else {
				document.getElementById(this.checkout_form).submit()
			}
		},
		postNoAlert(elem) {
			let url = R.path(['target', 'action'], elem) || elem.action,
				form = document.getElementById(elem.target.id) || elem,
				formData = new FormData(form),
				target = elem.target.action !== undefined ? elem.target : elem,
				body = {},
				actionType = uppercaseFirst(R.head(R.split('-', (R.head(R.split('_', target.id))))));

			this.$http.post(url, formData).then((response) => {
				body = response.body;
			});
		},
	},
	ready() {
		var $errorModal = $('#projects-modal-show-error')
		$errorModal.modal();
		if (!this.store.project.read_at && this.store.project.error) {
			$errorModal.modal('open');
			this.postNoAlert(document.getElementById('read-at-form'));
		}
	}
};
