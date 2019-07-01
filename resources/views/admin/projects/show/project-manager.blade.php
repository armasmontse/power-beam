<h5>Project manager</h5>
<table>
	<tr>
		<td>
			<table>
				@if (!is_null($project->manager))
					<tr>
						<td style="width: 20px;"><i class="material-icons">supervisor_account</i></td>
						<td>
							{{ $project->manager->full_name }}
						</td>
					</tr>
					<tr>
						<td style="width: 20px;"><i class="material-icons">email</i></td>
						<td>
							<a href="mailto:{{ $project->manager->email }}">
								{{ $project->manager->email }}
							</a>
						</td>
					</tr>
				@else
					<tr>
						<td>There is no project manager assigned to this project. Go <a class="red-text" href="{{ route('admin::projects.edit', ['admin_project' => $project->id]) }}">here</a> to take the project.</td>
					</tr>
				@endif
			</table>
		</td>
	</tr>
</table>