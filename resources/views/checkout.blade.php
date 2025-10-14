@extends('layouts.app')

@section('title', 'Checkout - Fashion Shop')

@section('content')

<!--=========================-->
<!--=   Checkout Section    =-->
<!--=========================-->

<section class="checkout-section" style="padding: 80px 0; background: #f8f9fa;">
	<div class="container">
		<!-- Page Header -->
		<div class="row mb-5">
			<div class="col-12 text-center">
				<h2 style="font-size: 36px; font-weight: 700; color: #000; margin-bottom: 15px;">
					<i class="fas fa-lock" style="color: #FFD700;"></i> SECURE CHECKOUT
				</h2>
				<p style="color: #666; font-size: 16px;">Complete your order securely</p>
			</div>
		</div>

	@if($errors->any())
	<div class="alert alert-danger" style="margin-bottom: 30px;">
		<ul style="margin: 0; padding-left: 20px;">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
			@csrf
			
			<div class="row">
				<!-- Left Column - Checkout Form -->
				<div class="col-lg-8">
					<!-- Shipping Information -->
					<div class="checkout-card" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #FFD700;">
							<span style="background: #000; color: #FFD700; padding: 8px 15px; border-radius: 50%; margin-right: 10px;">1</span>
							SHIPPING INFORMATION
						</h4>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Full Name <span style="color: #e74c3c;">*</span>
								</label>
								<input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Email <span style="color: #e74c3c;">*</span>
								</label>
								<input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Phone Number <span style="color: #e74c3c;">*</span>
								</label>
								<input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

						<div class="col-md-6 mb-3">
							<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
								Country <span style="color: #e74c3c;">*</span>
							</label>
							<select name="country" class="form-control" required
									style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
								<option value="">Select Country</option>
								<option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
								<option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
							</select>
						</div>

							<div class="col-12 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Address Line 1 <span style="color: #e74c3c;">*</span>
								</label>
								<input type="text" name="address" class="form-control" value="{{ old('address') }}" required
									   placeholder="Street address, P.O. box, company name"
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

							<div class="col-12 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Address Line 2 <span style="color: #999; font-size: 13px;">(Optional)</span>
								</label>
								<input type="text" name="address_2" class="form-control" value="{{ old('address_2') }}"
									   placeholder="Apartment, suite, unit, building, floor, etc."
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

							<div class="col-md-4 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									City <span style="color: #e74c3c;">*</span>
								</label>
								<input type="text" name="city" class="form-control" value="{{ old('city') }}" required
									   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
							</div>

						<div class="col-md-4 mb-3">
							<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
								State/Province <span style="color: #999; font-size: 13px;">(Optional)</span>
							</label>
							<input type="text" name="state" class="form-control" value="{{ old('state') }}"
								   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
								   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
						</div>

						<div class="col-md-4 mb-3">
							<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
								Postal Code <span style="color: #999; font-size: 13px;">(Optional)</span>
							</label>
							<input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}"
								   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
								   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">
						</div>
						</div>
					</div>

					<!-- Billing Information -->
					<div class="checkout-card" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #FFD700;">
							<span style="background: #000; color: #FFD700; padding: 8px 15px; border-radius: 50%; margin-right: 10px;">2</span>
							BILLING INFORMATION
						</h4>

						<div class="form-check mb-3">
							<input type="checkbox" class="form-check-input" id="billingSame" name="billing_same" checked
								   style="width: 20px; height: 20px; cursor: pointer;">
							<label class="form-check-label" for="billingSame" style="color: #333; font-weight: 600; margin-left: 10px; cursor: pointer;">
								Same as shipping address
							</label>
						</div>

						<div id="billingFields" style="display: none;">
							<div class="row">
								<div class="col-12 mb-3">
									<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Billing Address</label>
									<input type="text" name="billing_address" class="form-control"
										   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px;">
								</div>
								<div class="col-md-4 mb-3">
									<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">City</label>
									<input type="text" name="billing_city" class="form-control"
										   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px;">
								</div>
								<div class="col-md-4 mb-3">
									<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">State</label>
									<input type="text" name="billing_state" class="form-control"
										   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px;">
								</div>
								<div class="col-md-4 mb-3">
									<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Postal Code</label>
									<input type="text" name="billing_postal_code" class="form-control"
										   style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px;">
								</div>
							<div class="col-12 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">Country</label>
								<select name="billing_country" class="form-control"
										style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px 15px;">
									<option value="">Select Country</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Egypt">Egypt</option>
								</select>
							</div>
							</div>
						</div>
					</div>

					<!-- Payment Method -->
					<div class="checkout-card" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #FFD700;">
							<span style="background: #000; color: #FFD700; padding: 8px 15px; border-radius: 50%; margin-right: 10px;">3</span>
							PAYMENT METHOD
						</h4>

						<div class="payment-options">
							<div class="payment-option" style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 15px; cursor: pointer; transition: all 0.3s;"
								 onclick="selectPayment('cod', this)">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="payment_method" value="cod" id="cod" checked
										   style="width: 20px; height: 20px;">
									<label class="form-check-label" for="cod" style="margin-left: 10px; cursor: pointer;">
										<strong style="color: #000; font-size: 16px;">💵 Cash on Delivery</strong>
										<p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Pay when you receive your order</p>
									</label>
								</div>
							</div>

							<div class="payment-option" style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 15px; cursor: pointer; transition: all 0.3s;"
								 onclick="selectPayment('card', this)">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="payment_method" value="card" id="card"
										   style="width: 20px; height: 20px;">
									<label class="form-check-label" for="card" style="margin-left: 10px; cursor: pointer;">
										<strong style="color: #000; font-size: 16px;">💳 Credit/Debit Card</strong>
										<p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Pay securely with your card</p>
									</label>
								</div>
							</div>

							<div class="payment-option" style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 20px; cursor: pointer; transition: all 0.3s;"
								 onclick="selectPayment('bank_transfer', this)">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="payment_method" value="bank_transfer" id="bank_transfer"
										   style="width: 20px; height: 20px;">
									<label class="form-check-label" for="bank_transfer" style="margin-left: 10px; cursor: pointer;">
										<strong style="color: #000; font-size: 16px;">🏦 Bank Transfer</strong>
										<p style="color: #666; margin: 5px 0 0 0; font-size: 14px;">Transfer payment to our bank account</p>
									</label>
								</div>
							</div>
						</div>
					</div>

					<!-- Order Notes -->
					<div class="checkout-card" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #FFD700;">
							<span style="background: #000; color: #FFD700; padding: 8px 15px; border-radius: 50%; margin-right: 10px;">4</span>
							ORDER NOTES <span style="color: #999; font-size: 14px; font-weight: 400;">(Optional)</span>
						</h4>

						<textarea name="notes" class="form-control" rows="4" placeholder="Special instructions for delivery..."
								  style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 15px; font-size: 15px; resize: vertical;"
								  onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='#e0e0e0'">{{ old('notes') }}</textarea>
					</div>
				</div>

				<!-- Right Column - Order Summary -->
				<div class="col-lg-4">
					<div class="order-summary" style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); position: sticky; top: 100px;">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #FFD700;">
							ORDER SUMMARY
						</h4>

						<!-- Product List -->
						<div class="order-items-list" style="max-height: 300px; overflow-y: auto; margin-bottom: 20px;">
							@foreach($cartItems as $item)
							<div class="summary-item" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px 0; border-bottom: 1px solid #f5f5f5; transition: background-color 0.2s ease;">
								<div style="flex: 1; margin-right: 10px;">
									<div style="font-weight: 600; color: #333; font-size: 13px; margin-bottom: 4px; line-height: 1.3;">
										{{ \Illuminate\Support\Str::limit($item->product->name, 25) }}
									</div>
									<div style="font-size: 12px; color: #666; font-weight: 500;">
										{{ $item->quantity }} × ${{ number_format($item->product->final_price, 2) }}
									</div>
								</div>
								<div style="font-weight: 700; color: #1a1a1a; font-size: 14px; white-space: nowrap;">
									${{ number_format($item->product->final_price * $item->quantity, 2) }}
								</div>
							</div>
							@endforeach
						</div>

						<!-- Summary Totals -->
						<div class="order-totals" style="border-top: 2px solid #f0f0f0; padding-top: 15px; margin-top: 20px;">
							<div style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px; color: #666;">
								<span>Subtotal:</span>
								<strong style="color: #333; font-weight: 600;">${{ number_format($subtotal, 2) }}</strong>
							</div>
							<div style="display: flex; justify-content: space-between; padding: 15px 0 0 0; border-top: 2px solid #1a1a1a; margin-top: 10px; font-size: 18px; font-weight: 700; color: #1a1a1a;">
								<span>TOTAL:</span>
								<strong style="color: #28a745; font-size: 20px;">${{ number_format($total, 2) }}</strong>
							</div>
						</div>

						<!-- Place Order Button -->
						<button type="submit" class="btn btn-block" id="placeOrderBtn"
								style="width: 100%; background: #000; color: #FFD700; border: 2px solid #FFD700; padding: 15px; font-size: 18px; font-weight: 700; border-radius: 8px; margin-top: 25px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
								onmouseover="this.style.background='#FFD700'; this.style.color='#000'"
								onmouseout="this.style.background='#000'; this.style.color='#FFD700'">
							<i class="fas fa-lock"></i> PLACE ORDER - ${{ number_format($total, 2) }}
						</button>

						<a href="{{ route('cart') }}" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; font-size: 14px;">
							<i class="fas fa-arrow-left"></i> Back to Cart
						</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

@endsection

@push('styles')
<style>
	.payment-option:hover {
		border-color: #FFD700 !important;
		background: rgba(255, 215, 0, 0.05);
	}
	
	.payment-option input:checked + label {
		color: #FFD700;
	}
	
	.form-control:focus {
		outline: none;
		box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
	}
	
	/* Order Items List Scrollbar */
	.order-items-list::-webkit-scrollbar {
		width: 6px;
	}
	
	.order-items-list::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}
	
	.order-items-list::-webkit-scrollbar-thumb {
		background: #FFD700;
		border-radius: 10px;
	}
	
	.summary-item:hover {
		background-color: #fafafa;
		padding-left: 8px;
		margin-left: -8px;
		margin-right: -8px;
		padding-right: 8px;
		border-radius: 6px;
	}
</style>
@endpush

@push('scripts')
<script>
	// Toggle billing fields
	document.getElementById('billingSame').addEventListener('change', function() {
		const billingFields = document.getElementById('billingFields');
		billingFields.style.display = this.checked ? 'none' : 'block';
	});

	// Payment method selection
	function selectPayment(method, element) {
		// Remove active class from all
		document.querySelectorAll('.payment-option').forEach(opt => {
			opt.style.borderColor = '#e0e0e0';
			opt.style.background = 'white';
		});
		
		// Add active class to selected
		element.style.borderColor = '#FFD700';
		element.style.background = 'rgba(255, 215, 0, 0.05)';
		
		// Check the radio button
		document.getElementById(method).checked = true;
	}

	// Form submission
	document.getElementById('checkoutForm').addEventListener('submit', function(e) {
		const btn = document.getElementById('placeOrderBtn');
		btn.disabled = true;
		btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> PROCESSING...';
	});
</script>
@endpush

