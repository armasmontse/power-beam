<h5>Quotes</h5>
<table>
	@forelse($project->quotes as $quote)

		<tr>
			<th>Created</th>
			<th>Amount</th>
			<th>Status</th>
			<th></th>
		</tr>

		<tr>
			<th>{{ $quote->created_at->format('d/m/Y') }}</th>
			<td>{{ $quote->formated_amount }}</td>
			<td>
				@if ($quote->decision)
					Accepted
				@else
					Rejected
				@endif
			</td>
			<td>
				<a href="{{ $quote->admin_url }}" class="btn-floating btn-creel">
				    <i class="material-icons waves-effect waves-light">remove_red_eye</i>
				</a>
			</td>
		</tr>

	@empty

		<tr>
			<td>No quotes found on this project.</td>
		</tr>

	@endforelse
</table>