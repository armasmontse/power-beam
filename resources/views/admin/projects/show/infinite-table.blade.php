<table class="bordered">
	@foreach ($loop as $key => $data)
		<tr>
			<td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
			<td>
				@if (is_array($data))
					@include('admin.projects.show.infinite-table', ['loop' => $data])
				@else
					{{ $data }}
				@endif
			</td>
		</tr>
	@endforeach
</table>