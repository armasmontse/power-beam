@extends('layouts.admin')

@section('title')
    {!! trans('manage_quotes.show.label') !!}: {{$project->name}}
@endsection

@section('h1')
    {!! trans('manage_quotes.show.label') !!}: {{$project->name}}
@endsection

@section('action')
	<a href="{{ route('admin::projects.show', ['admin_project' => $project->id]) }}" class="btn-floating btn-icon">
	    <i class="material-icons waves-effect waves-light">keyboard_arrow_left</i>
	</a>
@endsection

@section('content')

	<div class="row">
		<div class="col s10 offset-s1">

			<div class="row">
				<div class="col s12">
					<h5>Details</h5>
					<table>
						<tr>
							<th>Amount</th>
							<td>{{ $quote->formated_amount }}</td>
						</tr>
						<tr>
							<th>File</th>
							<td>
								<a href="{{ $quote->file->url }}">
									<i class="material-icons">file_download</i>
								</a>
							</td>
						</tr>
						<tr>
							<th>Decision</th>
							<td>
								@if ($quote->decision)
									Accepted
								@else
									Rejected
								@endif
							</td>
						</tr>
						<tr>
							<th>Decision made</th>
							<td>
								@if (!is_null($quote->decided_at))
									{{ $quote->decided_at->format('d/m/Y H:m') }}
								@else
									Not decided yet.
								@endif
							</td>
						</tr>
						<tr>
							<th>Feedback</th>
							<td>
								@if (!is_null($quote->feedback))
									{{ $quote->feedback }}
								@else
									Not decided yet.
								@endif
							</td>
						</tr>
					</table>
				</div>
			</div>

			@if (!is_null($quote->payment))
				<div class="row">
				    <div class="divider"></div>
				</div>

				<div class="row">
					<div class="col s12">
						<h5>Payment</h5>
						<table>
							<tr>
								<th>Code</th>
								<td>{{ $quote->payment->code }}</td>
							</tr>
							<tr>
								<th>Amount paid</th>
								<td>{{ $quote->payment->formated_amount }}</td>
							</tr>
							<tr>
								<th>Status</th>
								<td>{{ $quote->payment->payment_status }}</td>
							</tr>
							<tr>
								<th>Payable</th>
								<td>
									<table>
										<tr>
											<th>Type</th>
											<td>
												{{ ucfirst(str_replace('_', ' ', $quote->payment->payable_type)) }}
											</td>
										</tr>
										<tr>
											<th>ID</th>
											<td>
												{{ $quote->payment->payable_id }}
											</td>
										</tr>
										@if ($quote->payment->payable_type == 'purchase_order')

										@endif
									</table>
								</td>
							</tr>
							@if (!empty($quote->payment->metadata))
								<tr>
									<th>Metadata</th>
									<td>
										@include('admin.projects.show.infinite-table', ['loop' => $quote->payment->metadata])
									</td>
								</tr>
							@endif
						</table>
					</div>
				</div>
			@endif

		</div>
	</div>

	

@endsection