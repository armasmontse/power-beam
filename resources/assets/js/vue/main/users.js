import Vue from 'vue';
import R from 'ramda';
import { fileUploaderCommunication } from '../mixins/file-uploader-mixin'
const tap = (...x) => { console.log.apply(null, x); return x[x.length - 1] }

export const usersVue = {
	el: '#users-vue',
	mixins: [fileUploaderCommunication],
	data: {
		emailForm: false,
		passwordForm: false,
	},
	computed: {
		// singleImageStyle() {//crea los estilos con los que se imprime la imagen, cuando la hay
		// 	let url = R.path(['store','current_news','thumbnail_image','thumbnail_url'], this)
		// 	if (url) {
		// 		return makeBackgroundImage(url)
		// 	} else {
		// 		return no_image
		// 	}
		// },
		// hasSingleImage() {
		// 	return this.singleImageStyle !== no_image
		// },
	},
	methods: {
		makePost(form_id) {
			this.post(document.getElementById(form_id))
		},
		onSingleimageupdateSuccess(body, input) {
			this.store.current_user.thumbnail_image = body.data
		},
	   	onSingleimageremoveSuccess(body, input) {
			this.store.current_user.thumbnail_image = no_image
	    },
	},
};


