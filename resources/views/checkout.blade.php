@extends('layouts.app')

@section('title', 'Checkout - Softyskin Luxury')

@section('content')

	<style>
		:root {
			--luxe-primary-gold: #D4AF37;
			--luxe-soft-gold: #C9A15B;
			--luxe-cream-bg: #F8F5EF;
			--luxe-soft-border: #E7E2D8;
			--luxe-black: #111111;
			--luxe-text-gray: #666666;
			--luxe-white: #FFFFFF;
		}

		.checkout-section {
			background-color: var(--luxe-cream-bg);
			padding: 80px 0;
			min-height: 100vh;
		}

		.luxe-card {
			background: var(--luxe-white);
			border-radius: 24px;
			padding: 40px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.05);
			border: 1px solid var(--luxe-soft-border);
		}

		/* Stepper */
		.step-indicator {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-bottom: 60px;
		}

		.step-item {
			display: flex;
			flex-direction: column;
			align-items: center;
			position: relative;
			width: 150px;
		}

		.step-circle {
			width: 48px;
			height: 48px;
			border-radius: 50%;
			background: #e0e0e0;
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			margin-bottom: 12px;
			transition: all 0.3s ease;
			z-index: 2;
			font-size: 18px;
		}

		.step-item.active .step-circle {
			background: var(--luxe-primary-gold);
			box-shadow: 0 0 0 6px rgba(212, 175, 55, 0.15);
		}

		.step-item.completed .step-circle {
			background: var(--luxe-soft-gold);
			color: #fff;
		}

		.step-label {
			font-size: 13px;
			font-weight: 700;
			color: #999;
			text-transform: uppercase;
			letter-spacing: 0.1em;
		}

		.step-item.active .step-label {
			color: var(--luxe-black);
		}

		.step-line {
			height: 1px;
			background: var(--luxe-soft-border);
			width: 100px;
			margin: 0 -25px 30px -25px;
			z-index: 1;
		}

		/* Form Styling */
		.checkout-heading {
			font-family: 'Cormorant Garamond', serif;
			font-size: 32px;
			font-weight: 700;
			color: var(--luxe-black);
			margin-bottom: 35px;
		}

		.luxe-label {
			font-family: 'Inter', sans-serif;
			font-weight: 600;
			font-size: 14px;
			color: var(--luxe-black);
			margin-bottom: 8px;
			display: block;
		}

		.luxe-input {
			height: 56px;
			border-radius: 14px;
			border: 1px solid var(--luxe-soft-border);
			padding: 0 18px;
			width: 100%;
			font-family: 'Inter', sans-serif;
			transition: all 0.25s ease;
			font-size: 15px;
			background: #fff;
		}

		.luxe-input:focus {
			border-color: var(--luxe-primary-gold);
			outline: none;
			box-shadow: none;
		}

		.luxe-select {
			appearance: none;
			background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%23111111' stroke-width='2'/%3E%3C/svg%3E");
			background-repeat: no-repeat;
			background-position: right 20px center;
		}

		.luxe-textarea {
			height: auto;
			padding: 18px;
			border-radius: 14px;
		}

		/* Buttons */
		.btn-luxe-primary {
			background: var(--luxe-black);
			color: #fff;
			height: 56px;
			padding: 0 35px;
			border-radius: 14px;
			font-weight: 700;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border: none;
			transition: all 0.25s ease;
			cursor: pointer;
		}

		.btn-luxe-primary:hover {
			background: #000;
			transform: translateY(-2px);
			color: #fff;
			text-decoration: none;
		}

		.btn-luxe-secondary {
			background: #F5F1EA;
			color: var(--luxe-black);
			height: 56px;
			padding: 0 35px;
			border-radius: 14px;
			font-weight: 700;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border: none;
			transition: all 0.25s ease;
			cursor: pointer;
		}

		.btn-luxe-secondary:hover {
			background: #ede8df;
			transform: translateY(-2px);
			text-decoration: none;
			color: var(--luxe-black);
		}

		/* Order Summary Items */
		.summary-item-card {
			display: flex;
			align-items: center;
			gap: 20px;
			padding-bottom: 20px;
			margin-bottom: 20px;
			border-bottom: 1px solid var(--luxe-soft-border);
		}

		.summary-item-img {
			width: 90px;
			height: 90px;
			border-radius: 12px;
			object-fit: cover;
			background: var(--luxe-cream-bg);
		}

		.summary-item-name {
			font-family: 'Cormorant Garamond', serif;
			font-size: 18px;
			font-weight: 700;
			color: var(--luxe-black);
			margin: 0;
		}

		.summary-item-price {
			font-family: 'Inter', sans-serif;
			font-size: 15px;
			color: var(--luxe-text-gray);
		}

		.summary-total-area {
			background: var(--luxe-cream-bg);
			border-radius: 16px;
			padding: 24px;
			margin-top: 30px;
		}

		.total-row {
			display: flex;
			justify-content: space-between;
			margin-bottom: 12px;
			font-size: 15px;
			color: var(--luxe-text-gray);
		}

		.total-row.final {
			margin-top: 15px;
			padding-top: 15px;
			border-top: 1px solid var(--luxe-soft-border);
			color: var(--luxe-black);
			font-weight: 800;
			font-size: 20px;
		}

		.luxe-gold-text {
			color: var(--luxe-primary-gold);
		}

		/* Trust Bar */
		.summary-trust-bar {
			display: flex;
			justify-content: space-between;
			margin-top: 40px;
			padding-top: 30px;
			border-top: 1px solid var(--luxe-soft-border);
		}

		.trust-icon-item {
			display: flex;
			align-items: center;
			gap: 10px;
			font-size: 12px;
			font-weight: 700;
			color: var(--luxe-text-gray);
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}

		.trust-icon-item i {
			color: var(--luxe-primary-gold);
			font-size: 16px;
		}

		@media (max-width: 991px) {
			.step-indicator { margin-bottom: 40px; }
			.step-item { width: 100px; }
			.step-line { width: 50px; }
			.luxe-card { padding: 30px 20px; }
			.summary-trust-bar { flex-direction: column; gap: 15px; align-items: center; }
		}
	</style>

	<section class="checkout-section">
		<div class="container container-two">
			
			<div class="step-indicator">
				<div class="step-item active" id="indicator-1">
					<div class="step-circle">1</div>
					<span class="step-label">Shipping</span>
				</div>
				<div class="step-line"></div>
				<div class="step-item" id="indicator-2">
					<div class="step-circle">2</div>
					<span class="step-label">Summary</span>
				</div>
			</div>

			@if($errors->any())
				<div class="row justify-content-center mb-5">
					<div class="col-lg-8">
						<div class="alert alert-danger luxe-card border-0 mb-0" style="background: #fff5f5; border-radius: 14px; padding: 20px;">
							<ul class="mb-0">
								@foreach($errors->all() as $error)
									<li style="color: #c53030; font-size: 14px; font-weight: 600;">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			@endif

			<form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
				@csrf
				<input type="hidden" name="payment_method" value="cod">

				<!-- Step 1: Shipping Information -->
				<div class="checkout-step" id="step-1">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="luxe-card reveal">
								<h2 class="checkout-heading">Shipping Information</h2>

								<div class="row">
									<div class="col-md-6 mb-4">
										<label class="luxe-label">Full Name *</label>
										<input type="text" name="name" class="luxe-input" value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="Enter your full name" required>
									</div>
									<div class="col-md-6 mb-4">
										<label class="luxe-label">Email *</label>
										<input type="email" name="email" class="luxe-input" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="Enter your email" required>
									</div>
									<div class="col-md-6 mb-4">
										<label class="luxe-label">Phone Number *</label>
										<input type="tel" name="phone" class="luxe-input" value="{{ old('phone') }}" placeholder="Enter your phone" required>
									</div>
									<div class="col-md-6 mb-4">
										<label class="luxe-label">Country *</label>
										<select name="country" class="luxe-input luxe-select" required>
											<option value="">Select Country</option>
											<option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
											<option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
										</select>
									</div>
									<div class="col-12 mb-4">
										<label class="luxe-label">Address Line 1 *</label>
										<input type="text" name="address" class="luxe-input" value="{{ old('address') }}" placeholder="Street address, P.O. box, company name" required>
									</div>
									<div class="col-12 mb-4">
										<label class="luxe-label">Address Line 2 (Optional)</label>
										<input type="text" name="address_2" class="luxe-input" value="{{ old('address_2') }}" placeholder="Apartment, suite, unit, building, floor, etc.">
									</div>
									<div class="col-md-12 mb-4">
										<label class="luxe-label">City (Optional)</label>
										<input type="text" name="city" class="luxe-input" value="{{ old('city') }}" placeholder="Enter your city">
									</div>
									<div class="col-12 mb-4">
										<label class="luxe-label">Order Notes (Optional)</label>
										<textarea name="notes" class="luxe-input luxe-textarea" rows="4" placeholder="Special instructions for delivery...">{{ old('notes') }}</textarea>
									</div>
								</div>

								<div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
									<a href="{{ route('cart') }}" class="btn-luxe-secondary">Back To Cart</a>
									<button type="button" class="btn-luxe-primary next-step" data-next="2">Continue to summary <i class="fa fa-arrow-right ml-2"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Step 2: Order Summary -->
				<div class="checkout-step" id="step-2" style="display: none;">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="luxe-card reveal">
								<h2 class="checkout-heading">Order Summary</h2>

								<div class="summary-items-list mb-4">
									<h5 class="luxe-label mb-4"><i class="fa fa-shopping-bag luxe-gold-text mr-2"></i> Your Items</h5>
									@foreach($cartItems as $item)
										<div class="summary-item-card">
											<div style="width: 90px; height: 90px; flex-shrink: 0;">
												<img src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/car1.jpg') }}" alt="{{ $item->product->name }}" class="summary-item-img">
											</div>
											<div class="flex-grow-1">
												<h4 class="summary-item-name">{{ $item->product->name }}</h4>
												<p class="summary-item-price">Quantity: {{ $item->quantity }} × @price($item->product->final_price)</p>
											</div>
											<div class="font-weight-bold luxe-black" style="font-size: 16px;">@price($item->product->final_price * $item->quantity)</div>
										</div>
									@endforeach
								</div>

								<div class="summary-total-area">
									<div class="total-row">
										<span>Subtotal</span>
										<span>@price($subtotal)</span>
									</div>
									<div class="total-row">
										<span>Shipping</span>
										<span class="text-success">Free</span>
									</div>
									<div class="total-row final">
										<span>TOTAL</span>
										<span class="luxe-gold-text">@price($total)</span>
									</div>
								</div>

								<div class="d-flex justify-content-between align-items-center mt-5 pt-4">
									<button type="button" class="btn-luxe-secondary prev-step" data-prev="1">Previous</button>
									<button type="submit" class="btn-luxe-primary px-5" id="placeOrderBtn">
										<i class="fa fa-lock mr-2"></i> Place Order - @price($total)
									</button>
								</div>

								<div class="summary-trust-bar">
									<div class="trust-icon-item"><i class="fa fa-check-circle"></i> Secure Checkout</div>
									<div class="trust-icon-item"><i class="fa fa-sync-alt"></i> Easy Returns</div>
									<div class="trust-icon-item"><i class="fa fa-headset"></i> Support 24/7</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const steps = document.querySelectorAll('.checkout-step');
			const indicators = document.querySelectorAll('.step-item');

			function showStep(stepNum) {
				steps.forEach(s => s.style.display = 'none');
				document.getElementById('step-' + stepNum).style.display = 'block';
				
				indicators.forEach(ind => {
					const id = parseInt(ind.id.split('-')[1]);
					ind.classList.remove('active', 'completed');
					if (id === stepNum) ind.classList.add('active');
					if (id < stepNum) ind.classList.add('completed');
				});

				window.scrollTo({ top: 0, behavior: 'smooth' });
			}

			document.querySelectorAll('.next-step').forEach(btn => {
				btn.addEventListener('click', function() {
					if (validateStep(1)) {
						showStep(2);
					}
				});
			});

			document.querySelectorAll('.prev-step').forEach(btn => {
				btn.addEventListener('click', function() {
					showStep(1);
				});
			});

			function validateStep(stepNum) {
				if (stepNum === 1) {
					const required = ['name', 'email', 'phone', 'address', 'country'];
					let valid = true;
					required.forEach(name => {
						const input = document.querySelector(`[name="${name}"]`);
						if (!input.value.trim()) {
							input.style.borderColor = '#c53030';
							valid = false;
						} else {
							input.style.borderColor = 'var(--luxe-soft-border)';
						}
					});
					return valid;
				}
				return true;
			}
		});
	</script>

@endsection
