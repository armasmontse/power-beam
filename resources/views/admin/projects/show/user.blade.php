<h5>User</h5>
<table>
	<tr>
		<td>
			<table>
				<tr>
					<td style="width: 20px;"><i class="material-icons">account_box</i></td>
					<td>{{ $project->user->full_name }}</td>
				</tr>
				<tr>
					<td style="width: 20px;"><i class="material-icons">email</i></td>
					<td><a href="mailto:{{ $project->user->email }}">{{ $project->user->email }}</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>