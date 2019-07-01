<h5>Notes</h5>
<table>
	@forelse($project->notes as $note)

		<tr>
			<th>{{ $note->created_at->format('d/m/Y') }}</th>
			<td>{{ $note->message }}</td>
		</tr>

	@empty

		<tr>
			<td>No notes found on this project.</td>
		</tr>

	@endforelse
</table>