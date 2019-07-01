<template id="file-uploader-template">
	<div>
		{{--  No hay archivo  --}}
		<div class="upload-box" style="height: initial; margin-bottom: 0;" v-if="file_data.name === ''">
			<div class="upload-box__box" draggable="true">
				<div class="upload-box__button-container">
					<i class="upload-box__icon fa fa-upload" aria-hidden="true"></i>
					<p class="upload-box__p">{{ trans('Drag & drop your file here or') }}</p>
					<span class="upload-box__pseudo-button">
						{{ trans('Browse your files') }}
					</span>
					<input class="upload-box__button file-input" form="file-upload_form" ref="file" type="file" name="avatar" @change="filesChange">
				</div>
				<div v-if="!showProgressBar">
					<span v-if="uploaded_file_name" v-text="uploaded_file_name"></span>
					{{-- <span v-else>{{ trans('Select file...') }}</span> --}}
				</div>
				{{-- <input v-if="showSendButton" class="upload-box__pseudo-button upload-box__pseudo-button--send" form="file-upload_form" type="submit" value="mandar" @click="sendFile"> --}}
			</div>

			<div>
				<div v-if="showProgressBar" class="upload-box__bar-container">
					<div class="upload-box__bar" :style="{width: upload_progress + '%'}"></div>
				</div>
				<p v-if="showProgressBar" class="upload-box__p upload-box__p--filename">
					<span v-if="!sending_succeded">{{ trans('Processing...') }}: </span>
					<span v-else>{{ trans('Uploaded') }}:</span>
					<span v-text="uploaded_file_name"></span>
				</p>
			</div>
		</div>
		{{--  Hay archivo  --}}
		<div class="upload-box" v-if="file_data.name != ''">
			<div class="upload-box__button-container">
				<a class="upload-box__link" :href="file_data.url" target="_blank">
					<i class="upload-box__icon fa fa-file" aria-hidden="true"></i>
					<p class="FileNameToDelete" v-text="file_data.name"></p>
				</a>
				<p @click="deleteFile" class="upload-box__button-container--deleteFile">{{ trans('Erase') }}</p>
			</div>
		</div>
	</div>
</template>
