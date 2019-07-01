<h5>Project info</h5>

<br>

<table>
	<tr>
		<td>BOM</td>
		<td>
			@if ($project->hasFile('bom'))
				<table class="bordered">
					<tr>
						<td>Download file [bom]</td>
						<td>
							<a href="{{ $project->getFileByUse('bom')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif
		</td>
	</tr>
	<tr>
		<td>DWG</td>
		<td>
			@if ($project->hasFile('dwg'))
				<table class="bordered">
					<tr>
						<td>Download file [dwg]</td>
						<td>
							<a href="{{ $project->getFileByUse('dwg')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif
		</td>
	</tr>
	<tr>
		<td>Data</td>
		<td>
			@if ($project->hasFile('data'))
				<table class="bordered">
					<tr>
						<td>Download file [data]</td>
						<td>
							<a href="{{ $project->getFileByUse('data')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif

			@if (is_array(array_get($project->production->data, 'data')))
				@include('admin.projects.show.infinite-table', ['loop' => array_get($project->production->data, 'data')])
			@else 
				{{ array_get($project->production->data, 'data') }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Geometry info</td>
		<td>
			@if ($project->hasFile('dwg_'))
				<table class="bordered">
					<tr>
						<td>Download file [dwg_]</td>
						<td>
							<a href="{{ $project->getFileByUse('dwg_')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif
		</td>
	</tr>
	<tr>
		<td>Stackup info</td>
		<td>
			@if ($project->hasFile('stackup'))
				<table class="bordered">
					<tr>
						<td>Download file [stackup]</td>
						<td>
							<a href="{{ $project->getFileByUse('stackup')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif

			@if (is_array(array_get($project->production->stackup, 'data')))
				@include('admin.projects.show.infinite-table', ['loop' => array_get($project->production->stackup, 'data')])
			@else 
				{{ array_get($project->production->stackup, 'data') }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Routing</td>
		<td>
			@if ($project->hasFile('routing'))
				<table class="bordered">
					<tr>
						<td>Download file [routing]</td>
						<td>
							<a href="{{ $project->getFileByUse('routing')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif

			@if (is_array(array_get($project->production->routing, 'data')))
				@include('admin.projects.show.infinite-table', ['loop' => array_get($project->production->routing, 'data')])
			@else 
				{{ array_get($project->production->routing, 'data') }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Highspeed</td>
		<td>
			@if (is_array(array_get($project->production->highspeed, 'data')))
				@include('admin.projects.show.infinite-table', ['loop' => array_get($project->production->highspeed, 'data')])
			@else 
				{{ array_get($project->production->highspeed, 'data') }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Power supply</td>
		<td>
			@if (is_array(array_get($project->production->power_supply, 'data')))
				@include('admin.projects.show.infinite-table', ['loop' => array_get($project->production->power_supply, 'data')])
			@else 
				{{ array_get($project->production->power_supply, 'data') }}
			@endif
		</td>
	</tr>
	<tr>
		<td>Altium and Orcad</td>
		<td>
			@if ($project->hasFile('data'))
				<table class="bordered">
					<tr>
						<td>Download file [data]</td>
						<td>
							<a href="{{ $project->getFileByUse('data')->url }}">
								<i class="material-icons">file_download</i>
							</a>
						</td>
					</tr>
				</table>
			@else
				-
			@endif
		</td>
	</tr>
</table>