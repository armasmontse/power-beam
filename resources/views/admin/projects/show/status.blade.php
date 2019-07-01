<h5>Status</h5>
<table>
	<tr>
		<td>Status</td>
		<td>{{ $project->status->label }}</td>
	</tr>
	@if ($project->status->hasSteps())
		<tr>
			<td>Step</td>
			<td>{{ $project->currentStep()->title }}</td>
		</tr>
	@endif
	<tr>
		<td>Group</td>
		<td>{{ $project->status->group->title }}</td>
	</tr>
</table>