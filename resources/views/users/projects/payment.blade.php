@extends('layouts.user', ['body_id' => 'projects-vue'])

@section('content')
	
	<div class="container-user container-height">
		<div class="row row-height">
			<div class="col s12 m3 l2 projects__navbar">
				@include('users.projects._nav')
			</div>
			<div class="col s12 m9 l10">
				<div class="col l10 offset-l1">

					<div class="card projects__card">
						<div class="card-content projects__card-content">
					        <h4 class="fz-20 black-text projects__sbttl--step">
					        	{{ trans('Payment') }} 
					        	@if ($payment->payable_type == 'stripe')
					        		{{ trans('Credit Card') }}
					        	@elseif($payment->payable_type == 'purchase_order')
					        		{{ trans('Purchase Order') }}
					        	@endif
					        </h4>
							<p class="fz-16 projects__text">{{ trans('Thank you for the purchase order. We will now proceed to the next step.') }}</p>
							<h4 class="fz-16 ">{{ trans('Reference number') }}: {{ $payment->code }}</h4> 
							<h4 class="fz-16">{{ $payment->created_at->format('d/m/Y') }}</h4>		
							<h4 class="fz-16 RobMedium golden">Amount: {{ $payment->formated_amount }}</h4>
				       		<a href="{{ $quote->file->url }}" class="fz-13 red-link flex projects__payment-downland mt-0 fb500">
				       			{{ trans('Download quote') }} <i class="material-icons projects__payment--iconDownload">file_download</i>
				       		</a>
					     	<div class="projects__card-content--btn">
								<a href="{{ $project->show_url }}" class="waves-effect waves-light btn">{{ trans('Continue') }}</a>
							</div> 
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection