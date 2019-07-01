<div class="filterSearch">
	<div class="input-field col s12 m6 offset-l1 l4 mb-5">
		<i class="material-icons prefix">search</i>
		<select v-model="filter_by" class="">
			<option value="" default disabled>Select a filter</option>
			<option  v-for="option in filters" :value="$key" v-text="option.description"></option>
		</select>
	</div>
	<div class="col l4 col s12 m5 mb-5">
		<input v-model="search"  class="search validate " placeholder="Search" type="text">
	</div>
</div>