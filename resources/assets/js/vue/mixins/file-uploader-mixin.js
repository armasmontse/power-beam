import R from 'ramda';

const tap = (...x) => { console.log.apply(null, x); return x[x.length - 1] }

const emptyData = {path: '', name: '', id: -1}

export const fileUploaderMixin = {// lo usamos como mixin para usersVue, si se complejiza más este archivo, lo podemos mover de lugar
	data() {
		return {
			file_loaded: false,
			upload_progress: 0,
			uploaded_file_name: '',
			sending_succeded: undefined,
			sending_file: false,
			file_data: emptyData,
		}
	},
	props: [
		'fileData', //{path: String, name: String, id: Int}
		'name' // Name for the input.
	],
	ready() {
		if(!R.isEmpty(this.fileData) && !R.isNil(this.fileData)) {
			this.file_data = this.fileData//no modificamos la prop
		}
	},
	computed: {
		showSendButton() {
			return (this.file_loaded !== false
				&& this.sending_file !== true)
				|| this.sending_succeded === false
		},
		showProgressBar() {
			return this.sending_file || this.sending_succeded
		}
	},
	methods: {
		sendFile(e) {
			e.preventDefault();
			let self = this
			this.sending_file = true
			var formData = new FormData();
			formData.append('file', this.$el.querySelector('.upload-box__button').files[0]);
			axios.post(
				'/users/files/ajax',
				formData,
				{
					onUploadProgress({ lengthComputable, total, loaded }) {
						if (lengthComputable) {
							self.upload_progress = parseInt(loaded / total * 100, 10)
						} else {
							tap('Para este archivo no se puede medir el progreso de la carga')
						}
					}
				}
			)
			.then(body => {
				// this.$root.alert(body)
				// this.upload_progress = 0
				// this.uploaded_file_name = ''
				this.file_loaded = false
				this.sending_file = false
				this.sending_succeded = true
				this.file_data = body.data.file
			})
			.catch(err => {
				this.sending_file = false
				this.sending_succeded = false
				this.$root.alertError(err)
			})
		},
		deleteFile(e) {
			e.preventDefault();
			this.file_loaded = false
			this.upload_progress = 0
			this.uploaded_file_name = ''
			this.sending_succeded = undefined
			this.sending_file = false
			this.file_data = emptyData
		},
		filesChange(e) {
			if (R.path(['target', 'files', 0, 'name'], e)) {
				this.file_loaded = true
				this.uploaded_file_name = e.target.files[0].name
			}
			if (this.showSendButton) {
				this.sendFile(e);
			}
		}
	},
	watch: {
		file_data(newFile, oldFile) {
			if(newFile === emptyData) {
				oldFile['input_name'] = this.name;
				this.$dispatch('removeFile', oldFile)
			} else {
				newFile['input_name'] = this.name;
				this.$dispatch('addFile', newFile)
			}
		}
	}
}


export const fileUploaderCommunication = {//mixin para el la instancia padre
	data: {
		files:[]
	},
	events: {
		addFile(file) {
			this.files.push(file)
		},
		removeFile({name}) {
			this.files = this.files.filter(file => file.name !== name)
		}
	},
	methods: {
		filterFilesByUse(use) {
			return this.files.filter(file => file.input_name == use)
		}
	}
}
