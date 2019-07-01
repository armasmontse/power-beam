@extends('layouts.user')

@section('content')
	
	<div class="container-user user container-height">
		
		<div class="row row-height">
			
			<div class="col l6 m12 s12">
				@include('users._show_info_account')
				@include('users._update_profile_photo')
				@include('users._update_password_form')
				@include('users._update_email_form')
			</div>

			<div class="col l4 m12 s12 offset-l1">
				
				<div class="col s12 user__payment">
					{{ trans('user.payment.title') }}
				</div>

				@forelse ($user->payments as $payment)
					<div class="col s12">
						<div class="card">
							<div class="card-content">
								<p class="card-title"><b>{{ $payment->quote->project->name }}</b></p>
								<p class="card-title user__payment-project">{{ $payment->created_at->format('d/m/Y') }}</p>
								<p class="card-title user__payment-project">Code: {{ $payment->quote->project->code }}</p>
								<p class="card-title">{{ $payment->formated_amount }}</p>
								<p>Payment ID: {{ $payment->code }}</p>
							</div>
							<div class="card-action">
								<div class="flex-center">
									<a class="red-txt" href="{{ $payment->quote->project->show_url }}"><b>View Project</b></a>
								</div>
							</div>
					  </div>
					</div>
				@empty
					<div class="col s12">
						No payments has been made.
					</div>
				@endforelse

			</div>
		</div>
	</div>

@endsection

@section('vue_store')
	<script>
		mainVueStore.current_user =  {!! $user !!};
	</script>
@endsection
