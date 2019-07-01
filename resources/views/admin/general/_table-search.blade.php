<div class=" mt-5 mb-5">
	<select v-model="filter_by" class="col s12 l3 mb-5">
		<option value="" default disabled> {!! trans('admin.layout.tables.filter.select_label') !!} </option>
		<option  v-for="option in filters" :value="$key" v-text="option.description"></option>
	</select>
	<input v-model="search"  class="col s12 offset-l4 l5 mb-5" placeholder="{!! trans('admin.layout.tables.filter.search_label') !!}" type="text" >
</div>
