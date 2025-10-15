@extends('layouts.app')

@section('title', 'Checkout - Fashion Shop')

@section('content')

<!--=========================-->
<!--=   Checkout Section    =-->
<!--=========================-->

<section class="checkout-section" style="padding: 80px 0; background: #f8f9fa;">
	<div class="container">
		<!-- Page Header -->
		<div class="row mb-4">
			<div class="col-12 text-center">
				<h2 style="font-size: 28px; font-weight: 700; color: #000; margin-bottom: 30px;">
					Checkout
				</h2>
				
				<!-- Step Progress Indicator -->
				<div class="step-indicator" style="display: flex; justify-content: center; align-items: center; margin-bottom: 40px;">
					<!-- Step 1: Shipping -->
					<div class="step-item" data-step="1" style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
						<div class="step-circle active" style="width: 40px; height: 40px; border-radius: 50%; background: #007cba; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 8px;">1</div>
						<span class="step-label" style="font-size: 12px; color: #007cba; font-weight: 600;">Shipping</span>
					</div>
					
					<!-- Connecting Line -->
					<div class="step-line" style="width: 60px; height: 2px; background: #e0e0e0; margin-right: 20px;"></div>
					
					<!-- Step 2: Payment -->
					<div class="step-item" data-step="2" style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
						<div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #666; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 8px;">2</div>
						<span class="step-label" style="font-size: 12px; color: #666; font-weight: 600;">Payment</span>
					</div>
					
					<!-- Connecting Line -->
					<div class="step-line" style="width: 60px; height: 2px; background: #e0e0e0; margin-right: 20px;"></div>
					
					<!-- Step 3: Order -->
					<div class="step-item" data-step="3" style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
						<div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #666; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 8px;">3</div>
						<span class="step-label" style="font-size: 12px; color: #666; font-weight: 600;">Order</span>
					</div>
					
					<!-- Connecting Line -->
					<div class="step-line" style="width: 60px; height: 2px; background: #e0e0e0; margin-right: 20px;"></div>
					
					<!-- Step 4: Summary -->
					<div class="step-item" data-step="4" style="display: flex; flex-direction: column; align-items: center;">
						<div class="step-circle" style="width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: #666; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 8px;">4</div>
						<span class="step-label" style="font-size: 12px; color: #666; font-weight: 600;">Summary</span>
					</div>
				</div>
			</div>
		</div>

	@if($errors->any())
	<div class="alert alert-danger" style="margin-bottom: 30px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; position: relative; z-index: 1000;">
		<h5 style="color: #721c24; font-weight: bold; margin-bottom: 10px;">
			<i class="fas fa-exclamation-triangle"></i> Please fix the following errors:
		</h5>
		<ul style="margin: 0; padding-left: 20px; color: #721c24;">
			@foreach($errors->all() as $error)
				<li style="margin-bottom: 5px;">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	@if(session('error'))
	<div class="alert alert-danger" style="margin-bottom: 30px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; position: relative; z-index: 1000;">
		<h5 style="color: #721c24; font-weight: bold; margin-bottom: 10px;">
			<i class="fas fa-exclamation-triangle"></i> Error:
		</h5>
		<p style="margin: 0; color: #721c24;">{{ session('error') }}</p>
	</div>
	@endif

	@if(session('success'))
	<div class="alert alert-success" style="margin-bottom: 30px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; position: relative; z-index: 1000;">
		<h5 style="color: #155724; font-weight: bold; margin-bottom: 10px;">
			<i class="fas fa-check-circle"></i> Success:
		</h5>
		<p style="margin: 0; color: #155724;">{{ session('success') }}</p>
	</div>
	@endif

	<!-- Debug: Show all validation errors -->
	@if($errors->any())
	<div class="alert alert-warning" style="margin-bottom: 30px; background-color: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 8px; position: relative; z-index: 1000;">
		<h5 style="color: #856404; font-weight: bold; margin-bottom: 10px;">
			<i class="fas fa-bug"></i> Debug - All Validation Errors:
		</h5>
		<ul style="margin: 0; padding-left: 20px; color: #856404;">
			@foreach($errors->all() as $error)
				<li style="margin-bottom: 5px; font-weight: 500;">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
			@csrf
			
			<div class="row">
				<!-- Main Content Area -->
				<div class="col-12">
					<!-- Step 1: Shipping Information -->
					<div class="checkout-step" id="step-1" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #007cba;">
							Shipping Information
						</h4>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Full Name <span style="color: #e74c3c;">*</span>
								</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name ?? '') }}" required
									   style="border: 2px solid @error('name') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('name') #dc3545 @else #e0e0e0 @enderror'">
								@error('name')
									<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
										<i class="fas fa-exclamation-circle"></i> {{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Email <span style="color: #e74c3c;">*</span>
								</label>
								<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}" required
									   style="border: 2px solid @error('email') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('email') #dc3545 @else #e0e0e0 @enderror'">
								@error('email')
									<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
										<i class="fas fa-exclamation-circle"></i> {{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-md-6 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Phone Number <span style="color: #e74c3c;">*</span>
								</label>
								<input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required
									   style="border: 2px solid @error('phone') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('phone') #dc3545 @else #e0e0e0 @enderror'">
								@error('phone')
									<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
										<i class="fas fa-exclamation-circle"></i> {{ $message }}
									</div>
								@enderror
							</div>

						<div class="col-md-6 mb-3">
							<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
								Country <span style="color: #e74c3c;">*</span>
							</label>
							<select name="country" class="form-control @error('country') is-invalid @enderror" required
									style="border: 2px solid @error('country') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('country') #dc3545 @else #e0e0e0 @enderror'">
								<option value="">Select Country</option>
								<option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
								<option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
							</select>
							@error('country')
								<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
									<i class="fas fa-exclamation-circle"></i> {{ $message }}
								</div>
							@enderror
						</div>

							<div class="col-12 mb-3">
								<label style="color: #333; font-weight: 600; margin-bottom: 8px; display: block;">
									Address Line 1 <span style="color: #e74c3c;">*</span>
								</label>
								<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required
									   placeholder="Street address, P.O. box, company name"
									   style="border: 2px solid @error('address') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('address') #dc3545 @else #e0e0e0 @enderror'">
								@error('address')
									<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
										<i class="fas fa-exclamation-circle"></i> {{ $message }}
									</div>
								@enderror
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
								<input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required
									   style="border: 2px solid @error('city') #dc3545 @else #e0e0e0 @enderror; border-radius: 8px; padding: 12px 15px; font-size: 15px; transition: all 0.3s;"
									   onfocus="this.style.borderColor='#FFD700'" onblur="this.style.borderColor='@error('city') #dc3545 @else #e0e0e0 @enderror'">
								@error('city')
									<div class="invalid-feedback" style="display: block; color: #dc3545; font-size: 14px; margin-top: 5px;">
										<i class="fas fa-exclamation-circle"></i> {{ $message }}
									</div>
								@enderror
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
						
						<!-- Step Navigation Buttons -->
						<div class="step-navigation" style="display: flex; justify-content: space-between; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
							<a href="{{ route('cart') }}" class="btn btn-secondary" style="padding: 12px 24px; border-radius: 6px; text-decoration: none; color: #666; border: 1px solid #ddd;">
								Back to cart
							</a>
							<button type="button" class="btn btn-primary next-step" data-next="2" style="background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Next
							</button>
						</div>
					</div>

					<!-- Step 2: Payment Method -->
					<div class="checkout-step" id="step-2" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: none;">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #007cba;">
							Payment Method
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
						
						<!-- Step Navigation Buttons -->
						<div class="step-navigation" style="display: flex; justify-content: space-between; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
							<button type="button" class="btn btn-secondary prev-step" data-prev="1" style="background: #666; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Previous
							</button>
							<button type="button" class="btn btn-primary next-step" data-next="3" style="background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Next
							</button>
						</div>
					</div>

					<!-- Step 3: Order Notes -->
					<div class="checkout-step" id="step-3" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: none;">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #007cba;">
							Order Notes (Optional)
						</h4>

						<textarea name="notes" class="form-control" rows="4" placeholder="Special instructions for delivery..."
								  style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 15px; font-size: 15px; resize: vertical;"
								  onfocus="this.style.borderColor='#007cba'" onblur="this.style.borderColor='#e0e0e0'">{{ old('notes') }}</textarea>
						
						<!-- Step Navigation Buttons -->
						<div class="step-navigation" style="display: flex; justify-content: space-between; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
							<button type="button" class="btn btn-secondary prev-step" data-prev="2" style="background: #666; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Previous
							</button>
							<button type="button" class="btn btn-primary next-step" data-next="4" style="background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Next
							</button>
						</div>
					</div>

					<!-- Step 4: Order Summary -->
					<div class="checkout-step" id="step-4" style="background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: none;">
						<h4 style="color: #000; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid #007cba;">
							Order Summary
						</h4>

						<!-- Order Summary -->
						<div class="row justify-content-center">
							<div class="col-lg-8">
								<div class="order-summary-card" style="background: white; border-radius: 15px; padding: 40px; box-shadow: 0 8px 30px rgba(0,0,0,0.12); border: 1px solid #f0f0f0;">
									<!-- Main Order Summary Header -->
									<div class="summary-header" style="text-align: center; margin-bottom: 35px;">
										<h3 style="color: #1a1a1a; font-weight: 800; font-size: 28px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">
											ORDER SUMMARY
										</h3>
										<div style="width: 80px; height: 4px; background: linear-gradient(90deg, #007cba, #28a745); margin: 0 auto; border-radius: 2px;"></div>
									</div>

									<!-- Product Items Section -->
									<div class="items-section" style="background: #f8f9fa; border-radius: 12px; padding: 25px; margin-bottom: 25px;">
										<h5 style="color: #333; font-weight: 700; margin-bottom: 20px; font-size: 16px;">
											<i class="fas fa-shopping-bag" style="color: #007cba; margin-right: 8px;"></i>
											Your Items
										</h5>
										
										<div class="items-list" style="space-y: 15px;">
											@foreach($cartItems as $item)
											<div class="item-row" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #e9ecef; transition: all 0.3s ease;">
												<div class="item-details" style="flex: 1;">
													<div class="item-name" style="font-weight: 700; color: #1a1a1a; font-size: 16px; margin-bottom: 5px;">
														{{ $item->product->name }}
													</div>
													<div class="item-meta" style="color: #666; font-size: 14px; font-weight: 500;">
														{{ $item->quantity }} × ${{ number_format($item->product->final_price, 2) }}
													</div>
												</div>
												<div class="item-total" style="font-weight: 800; color: #1a1a1a; font-size: 18px; min-width: 80px; text-align: right;">
													${{ number_format($item->product->final_price * $item->quantity, 2) }}
												</div>
											</div>
											@endforeach
										</div>
									</div>

									<!-- Totals Section -->
									<div class="totals-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; padding: 25px;">
										<div class="subtotal-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #dee2e6;">
											<span style="font-size: 16px; color: #666; font-weight: 600;">Subtotal:</span>
											<span style="font-size: 18px; color: #333; font-weight: 700;">${{ number_format($subtotal, 2) }}</span>
										</div>
										
										<div class="total-row" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0 0 0; margin-top: 15px;">
											<span style="font-size: 22px; color: #1a1a1a; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">TOTAL:</span>
											<span style="font-size: 28px; color: #28a745; font-weight: 900; text-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);">${{ number_format($total, 2) }}</span>
										</div>
									</div>

								</div>
							</div>
						</div>
						
						<!-- Step Navigation Buttons -->
						<div class="step-navigation" style="display: flex; justify-content: space-between; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
							<button type="button" class="btn btn-secondary prev-step" data-prev="3" style="background: #666; color: white; padding: 12px 24px; border: none; border-radius: 6px; font-weight: 600;">
								Previous
							</button>
							<button type="submit" class="btn btn-success place-order-btn" id="placeOrderBtn" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 18px 40px; border: none; border-radius: 12px; font-weight: 800; font-size: 18px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4); transition: all 0.3s ease; min-width: 250px; cursor: pointer;">
								<i class="fas fa-lock" style="margin-right: 10px;"></i> 
								Place Order - ${{ number_format($total, 2) }}
							</button>
						</div>
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
	
	/* Mobile Responsive Step Indicator */
	@media (max-width: 768px) {
		.step-indicator {
			flex-wrap: wrap;
			justify-content: center;
		}
		
		.step-item {
			margin-right: 10px !important;
			margin-bottom: 10px;
		}
		
		.step-line {
			width: 30px !important;
			margin-right: 10px !important;
		}
		
		.step-circle {
			width: 35px !important;
			height: 35px !important;
			font-size: 14px;
		}
		
		.step-label {
			font-size: 10px !important;
		}
		
		.checkout-step {
			padding: 20px !important;
		}
		
		.step-navigation {
			flex-direction: column;
			gap: 10px;
		}
		
		.step-navigation .btn {
			width: 100%;
		}
	}
	
	/* Step Indicator - No Click Functionality */
	.step-item {
		cursor: default;
		pointer-events: none;
	}
	
	.step-circle {
		cursor: default;
		pointer-events: none;
	}
	
	.step-label {
		cursor: default;
		pointer-events: none;
	}
	
	/* Order Summary Enhancements */
	.order-summary-card {
		transition: all 0.3s ease;
	}
	
	.order-summary-card:hover {
		transform: translateY(-2px);
		box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
	}
	
	.item-row:hover {
		background-color: rgba(0, 124, 186, 0.05);
		padding-left: 10px;
		padding-right: 10px;
		margin-left: -10px;
		margin-right: -10px;
		border-radius: 8px;
	}
	
	.place-order-btn {
		position: relative;
		z-index: 10;
		pointer-events: auto !important;
	}
	
	.place-order-btn:hover {
		transform: translateY(-3px);
		box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6) !important;
		background: linear-gradient(135deg, #20c997 0%, #28a745 100%) !important;
	}
	
	.place-order-btn:active {
		transform: translateY(-1px);
	}
	
	.place-order-btn:focus {
		outline: 3px solid rgba(40, 167, 69, 0.3);
		outline-offset: 2px;
	}
	
	/* Mobile Responsive Order Summary */
	@media (max-width: 768px) {
		.order-summary-card {
			padding: 25px !important;
		}
		
		.summary-header h3 {
			font-size: 22px !important;
		}
		
		.item-name {
			font-size: 14px !important;
		}
		
		.item-total {
			font-size: 16px !important;
		}
		
		.total-row span:first-child {
			font-size: 18px !important;
		}
		
		.total-row span:last-child {
			font-size: 24px !important;
		}
		
		.place-order-btn {
			padding: 15px 30px !important;
			font-size: 16px !important;
			min-width: 200px !important;
		}
		
		.step-navigation {
			flex-direction: column;
			gap: 15px;
		}
		
		.step-navigation .btn {
			width: 100%;
		}
	}
	
</style>
@endpush

@push('scripts')
<script>
	let currentStep = 1;
	
	// Function to show all errors prominently
	function showAllErrors() {
		// Show all error alerts
		const errorAlerts = document.querySelectorAll('.alert-danger, .alert-warning');
		errorAlerts.forEach(alert => {
			alert.style.display = 'block';
			alert.style.position = 'relative';
			alert.style.zIndex = '9999';
			alert.style.backgroundColor = '#f8d7da';
			alert.style.border = '2px solid #dc3545';
			alert.style.color = '#721c24';
			alert.style.padding = '20px';
			alert.style.marginBottom = '20px';
			alert.style.borderRadius = '8px';
			alert.style.fontWeight = 'bold';
		});
		
		// Show all field errors
		const fieldErrors = document.querySelectorAll('.invalid-feedback');
		fieldErrors.forEach(error => {
			error.style.display = 'block';
			error.style.color = '#dc3545';
			error.style.fontWeight = 'bold';
			error.style.backgroundColor = '#f8d7da';
			error.style.padding = '8px';
			error.style.borderRadius = '4px';
			error.style.marginTop = '5px';
		});
		
		// Highlight invalid fields
		const invalidFields = document.querySelectorAll('.is-invalid');
		invalidFields.forEach(field => {
			field.style.borderColor = '#dc3545';
			field.style.backgroundColor = '#fff5f5';
		});
	}
	
	// Show errors on page load
	document.addEventListener('DOMContentLoaded', function() {
		showAllErrors();
		
		// Add real-time validation - clear errors when user starts typing
		const formFields = document.querySelectorAll('input, select, textarea');
		formFields.forEach(field => {
			field.addEventListener('input', function() {
				// Clear field error when user starts typing
				const fieldError = this.parentNode.querySelector('.field-error-message');
				if (fieldError) {
					fieldError.remove();
				}
				
				// Remove error styling
				this.classList.remove('is-invalid');
				this.style.borderColor = '#e0e0e0';
				this.style.backgroundColor = '';
				
				// Validate field in real-time
				validateField(this);
			});
		});
		
		// Also show errors when form is submitted
		document.getElementById('checkoutForm').addEventListener('submit', function(e) {
			showAllErrors();
		});
	});
	
	// Real-time field validation
	function validateField(field) {
		const fieldName = field.name;
		const value = field.value.trim();
		
		// Clear existing error
		const existingError = field.parentNode.querySelector('.field-error-message');
		if (existingError) {
			existingError.remove();
		}
		
		// Validate based on field type
		switch(fieldName) {
			case 'name':
				if (value && value.length < 3) {
					showFieldError('name', 'Full name must be at least 3 characters');
				}
				break;
			case 'email':
				if (value && !isValidEmail(value)) {
					showFieldError('email', 'Please enter a valid email address');
				}
				break;
			case 'address':
				if (value && value.length < 3) {
					showFieldError('address', 'Address must be at least 3 characters');
				}
				break;
		}
	}
	
	// Step Navigation
	document.addEventListener('DOMContentLoaded', function() {
		// Next step buttons with validation
		document.querySelectorAll('.next-step').forEach(btn => {
			btn.addEventListener('click', function() {
				const nextStep = this.getAttribute('data-next');
				const currentStep = this.closest('.checkout-step').id.split('-')[1];
				
				// Validate current step before proceeding
				if (validateStep(currentStep)) {
					showStep(nextStep);
				}
			});
		});
		
		// Previous step buttons
		document.querySelectorAll('.prev-step').forEach(btn => {
			btn.addEventListener('click', function() {
				const prevStep = this.getAttribute('data-prev');
				showStep(prevStep);
			});
		});
		
		// Step indicator clicks disabled - users cannot click on circles
		// document.querySelectorAll('.step-item').forEach(item => {
		// 	item.addEventListener('click', function() {
		// 		const step = this.getAttribute('data-step');
		// 		showStep(step);
		// 	});
		// });
	});
	
	function showStep(stepNumber) {
		// Hide all steps
		document.querySelectorAll('.checkout-step').forEach(step => {
			step.style.display = 'none';
		});
		
		// Show current step
		document.getElementById('step-' + stepNumber).style.display = 'block';
		
		// Update step indicator
		updateStepIndicator(stepNumber);
		
		// Step 4 is now just the order summary - no review needed
		
		currentStep = stepNumber;
	}
	
	// Validation function for each step with error display
	function validateStep(stepNumber) {
		let isValid = true;
		let errors = [];
		
		// Clear previous error displays
		clearStepErrors(stepNumber);
		
		switch(stepNumber) {
			case '1': // Shipping Information
				const name = document.querySelector('input[name="name"]').value.trim();
				const email = document.querySelector('input[name="email"]').value.trim();
				const phone = document.querySelector('input[name="phone"]').value.trim();
				const address = document.querySelector('input[name="address"]').value.trim();
				const city = document.querySelector('input[name="city"]').value.trim();
				const country = document.querySelector('select[name="country"]').value.trim();
				
				// Validate each field and show specific errors
				if (!name) {
					showFieldError('name', 'Full name is required');
					errors.push('Full name is required');
					isValid = false;
				} else if (name.length < 3) {
					showFieldError('name', 'Full name must be at least 3 characters');
					errors.push('Full name must be at least 3 characters');
					isValid = false;
				}
				
				if (!email) {
					showFieldError('email', 'Email is required');
					errors.push('Email is required');
					isValid = false;
				} else if (!isValidEmail(email)) {
					showFieldError('email', 'Please enter a valid email address');
					errors.push('Please enter a valid email address');
					isValid = false;
				}
				
				if (!phone) {
					showFieldError('phone', 'Phone number is required');
					errors.push('Phone number is required');
					isValid = false;
				}
				
				if (!address) {
					showFieldError('address', 'Address is required');
					errors.push('Address is required');
					isValid = false;
				} else if (address.length < 3) {
					showFieldError('address', 'Address must be at least 3 characters');
					errors.push('Address must be at least 3 characters');
					isValid = false;
				}
				
				if (!city) {
					showFieldError('city', 'City is required');
					errors.push('City is required');
					isValid = false;
				}
				
				if (!country) {
					showFieldError('country', 'Country is required');
					errors.push('Country is required');
					isValid = false;
				}
				break;
				
			case '2': // Payment Method
				const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
				if (!paymentMethod) {
					showStepError('Please select a payment method');
					errors.push('Please select a payment method');
					isValid = false;
				}
				break;
				
			case '3': // Order Notes (Optional - always valid)
				isValid = true;
				break;
				
			default:
				isValid = true;
		}
		
		// Show step-level error if there are validation errors
		if (!isValid && errors.length > 0) {
			showStepError('Please fix the following errors before proceeding:');
		}
		
		return isValid;
	}
	
	// Function to show field-specific errors
	function showFieldError(fieldName, message) {
		const field = document.querySelector(`[name="${fieldName}"]`);
		if (field) {
			// Add error class
			field.classList.add('is-invalid');
			field.style.borderColor = '#dc3545';
			field.style.backgroundColor = '#fff5f5';
			
			// Remove existing error message
			const existingError = field.parentNode.querySelector('.field-error-message');
			if (existingError) {
				existingError.remove();
			}
			
			// Add new error message
			const errorDiv = document.createElement('div');
			errorDiv.className = 'field-error-message';
			errorDiv.style.cssText = 'display: block; color: #dc3545; font-size: 14px; margin-top: 5px; font-weight: bold; background: #f8d7da; padding: 5px 8px; border-radius: 4px;';
			errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
			field.parentNode.appendChild(errorDiv);
		}
	}
	
	// Function to show step-level errors
	function showStepError(message) {
		// Remove existing step error
		const existingError = document.querySelector('.step-error-message');
		if (existingError) {
			existingError.remove();
		}
		
		// Add new step error
		const errorDiv = document.createElement('div');
		errorDiv.className = 'step-error-message alert alert-danger';
		errorDiv.style.cssText = 'margin-bottom: 20px; background-color: #f8d7da; border: 2px solid #dc3545; color: #721c24; padding: 15px; border-radius: 8px; position: relative; z-index: 1000; font-weight: bold;';
		errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
		
		// Insert at the top of the current step
		const currentStep = document.querySelector(`#step-${currentStep}`);
		if (currentStep) {
			currentStep.insertBefore(errorDiv, currentStep.firstChild);
		}
	}
	
	// Function to clear step errors
	function clearStepErrors(stepNumber) {
		// Clear field errors for current step
		const step = document.querySelector(`#step-${stepNumber}`);
		if (step) {
			// Remove field error messages
			const fieldErrors = step.querySelectorAll('.field-error-message');
			fieldErrors.forEach(error => error.remove());
			
			// Remove error classes from fields
			const invalidFields = step.querySelectorAll('.is-invalid');
			invalidFields.forEach(field => {
				field.classList.remove('is-invalid');
				field.style.borderColor = '#e0e0e0';
				field.style.backgroundColor = '';
			});
			
			// Remove step error message
			const stepError = step.querySelector('.step-error-message');
			if (stepError) {
				stepError.remove();
			}
		}
	}
	
	// Email validation helper
	function isValidEmail(email) {
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
	}

	function updateStepIndicator(activeStep) {
		document.querySelectorAll('.step-item').forEach((item, index) => {
			const stepNumber = index + 1;
			const circle = item.querySelector('.step-circle');
			const label = item.querySelector('.step-label');
			const line = item.querySelector('.step-line');
			
			if (stepNumber < activeStep) {
				// Completed steps
				circle.style.background = '#28a745';
				circle.style.color = 'white';
				label.style.color = '#28a745';
				if (line) line.style.background = '#28a745';
			} else if (stepNumber == activeStep) {
				// Current step
				circle.style.background = '#007cba';
				circle.style.color = 'white';
				label.style.color = '#007cba';
				if (line) line.style.background = '#e0e0e0';
			} else {
				// Future steps
				circle.style.background = '#e0e0e0';
				circle.style.color = '#666';
				label.style.color = '#666';
				if (line) line.style.background = '#e0e0e0';
			}
		});
	}
	

	// Payment method selection
	function selectPayment(method, element) {
		// Remove active class from all
		document.querySelectorAll('.payment-option').forEach(opt => {
			opt.style.borderColor = '#e0e0e0';
			opt.style.background = 'white';
		});
		
		// Add active class to selected
		element.style.borderColor = '#007cba';
		element.style.background = 'rgba(0, 124, 186, 0.05)';
		
		// Check the radio button
		document.getElementById(method).checked = true;
	}

	// Form submission - Instant submission, no processing delays
	document.getElementById('checkoutForm').addEventListener('submit', function(e) {
		console.log('Form submission triggered');
		const btn = document.getElementById('placeOrderBtn');
		
		// Just disable button, no processing text
		if (btn) {
			btn.disabled = true;
			btn.style.opacity = '0.7';
			btn.style.cursor = 'not-allowed';
		}
		
		// Form submits immediately - no delays
		console.log('Form submitting to server immediately...');
	});
	
	// Ensure Place Order button is always enabled and clickable
	document.addEventListener('DOMContentLoaded', function() {
		const placeOrderBtn = document.getElementById('placeOrderBtn');
		if (placeOrderBtn) {
			placeOrderBtn.disabled = false;
			placeOrderBtn.style.cursor = 'pointer';
			placeOrderBtn.style.opacity = '1';
			
			// Button now submits form immediately - no processing delays
			console.log('Place Order button ready for instant submission');
		}
	});
</script>
@endpush

