
var Vue = require('vue');
import {fileUploaderMixin} from '../mixins/file-uploader-mixin';

export const fileUploader = Vue.component('file-uploader',{
	template: '#file-uploader-template',
	mixins:[fileUploaderMixin]
});
