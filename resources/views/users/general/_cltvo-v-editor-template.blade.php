<script type="x/templates" id="cltvo-v-editor-template">
	<div class="">
		<label :for="name" class="input-label active">@{{ label }}</label>
		<br>
		<v-editor :content.sync='value'></v-editor>
		<input type="hidden" v-model="value" :name="name" :form ="form">
	</div>
</script>
