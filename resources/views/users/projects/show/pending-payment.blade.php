{{-- Title production --}}
@include('users.projects.show._prueba_production')

<div class="card projects__card">

	<div class="card-content projects__card-content">

        <h4 class="fz-20 black-text projects__sbttl--step">Step 3. Payment</h4>
			
		<p class="fz-16 projects__text">Please upload your purchase order.</p>

		<div>

        	<div class="project__quote flex">

				<h4 class="fz-20 RobMedium projects__payment golden">
					<strong>Amount:</strong> {{ $quote->formated_amount }}
				</h4>

   		        <a href="{{ $quote->file->url }}" target="_blank">
   			        <div class="center projects__card-center">
   						<i class="material-icons">file_download</i>
   						<p class="black-text">
   							{{ $quote->file->name }}<br>
   							{{ strtoupper($quote->created_at->format('d/m/Y, h:i a')) }}
   						</p>
   					</div>
   		        </a>

			</div>

        	<div class="projects__payment--creditCard">

        		<div class="projects__payment--checkbox">
					<input name="payment_method" type="radio" id="card" value="stripe" v-model="payment_method" />
					<label for="card">Credit Card</label>
        		</div>

				<div v-show="payment_method == 'stripe'">

					{{-- Aparece solo cuando le das click en Credit Card --}}
					<div id="card-add" class="projects__payment-content">
						@foreach ($cards as $card)
							<div class="projects__payment--checkbox">
								<input name="credit_card" type="radio" id="number_card_{{ $loop->index }}" value="{{ $card->id }}" v-model="selectedCard" />
								<label for="number_card_{{ $loop->index }}">*** *** *** {{ $card->last4 }} - {{ $card->brand }}</label>
			        		</div>
						@endforeach
						<div class="projects__payment--checkbox">
							<input class="checkout__creditcard--single--options" type="radio" name="credit_card" value="-1" id="new_creditcard" v-model="selectedCard">
							<label for="number_card1">New credit card</label>
		        		</div>
					</div>

					{{-- Aparece cuando das click en New card --}}
					<div id="newCard-add" class="projects__payment--newCard" v-show="newCreditCard" style="margin-left: 45px;">
				        <label for="card-element">
				              Credit or debit card
			            </label>
			            <div id="card-element">
			              <!-- a Stripe Element will be inserted here. -->
			            </div>
				    </div>

				</div>

				@if ($user->can_make_purchase_orders)
			      	<div class="projects__payment--checkbox">
						<input name="payment_method" type="radio" id="purchase_order" value="purchase_order" v-model="payment_method" />
						<label for="purchase_order">Purchase Order</label>
			      	</div>

			      	<div v-show="payment_method == 'purchase_order'">
			      		<file-uploader :file-data="null" name="purchase_order"></file-uploader>
			      	</div>
				@endif


		    </div>

		    <form id="checkout_form" method="POST" action="{{ route('user::projects.quotes.pay', ['user' => $user, 'user_project' => $project, 'quote' => $quote]) }}" @submit.prevent="makeCheckout">
		    	{{ csrf_field() }}
		    	<input type="hidden" name="payment_method" :value="payment_method">
		    	<div v-if="payment_method === 'stripe'">
		    		<input type="hidden" name="new_card" :value="newCreditCard ? 'true' : 'false'">
		    		<div v-if="newCreditCard">
		    			<input type="hidden" name="token" :value="stripe.token.id">
		    		</div>
		    		<div v-else>
		    			<input type="hidden" name="card_id" :value="selectedCard">
		    		</div>
		    	</div>
		    	<div v-if="payment_method === 'purchase_order'">
					<input type="hidden" :name="file.input_name" :value="file.id" v-for="file in files">
				</div>
				<div class="projects__card-content--btn">
					<button class="waves-effect waves-light btn" type="submit" value="Submit">PAY</button>
				</div>
          	</form>

        </div>
	</div>
</div>
