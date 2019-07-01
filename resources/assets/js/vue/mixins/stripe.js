/**
 * An object that posts the credit card details to Conekta and has default methods to automaticall post the full checkout form to the server.
 * Requires this.checkout_form to be defined in calling component
 * @type {Object}
 */
export const stripe = {
	data: {
		stripe: {
			token: {},
			error: {}
		},
		card: {}
	},

	methods: {
		stripePost() {
			window.stripe.createToken(this.card).then(result => {
				if (result.error) {
					// Inform the user if there was an error
					this.stripeError(result.error);
				} else {
					// Send the token to your server
					this.stripeSuccess(result.token);
				}
			});
		},

		stripeSuccess(token) {
			this.stripe.token = token;
			this.$nextTick(()=>{ 
				document.getElementById(this.checkout_form).submit()
			});
		},

		stripeError(error) {
 			let body = {
 				error: error.message
 			};
			this.waiting_for_stripe = false;
			this.alertError(body);
		},
	},

	ready() {
		var element = document.getElementById("card-element");

		if (element) {
			// Create an instance of the card Element
			this.card = elements.create('card');

			// Add an instance of the card Element into the `card-element` <div>
			this.card.mount('#card-element');
		}
	}
};
