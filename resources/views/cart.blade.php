@extends('layouts.app')

@section('title', 'Shopping Cart - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

	<section class="breadcrumb-area">
		<div class="container-fluid custom-container">
			<div class="row">
				<div class="col-xl-12">
					<div class="bc-inner">
						<p><a href="{{ route('home') }}">Home</a>  |  <a href="{{ route('collection') }}">Shop</a>  |  Shopping Cart</p>
					</div>
				</div>
				<!-- /.col-xl-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</section>

		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->

	<section class="cart-area">
		<div class="container-fluid custom-container">
			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fas fa-check-circle"></i> {{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fas fa-exclamation-circle"></i> {{ session('error') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			<div class="row">
				<div class="col-xl-9">
					@if($cartItems->isEmpty())
						<!-- Empty Cart Message -->
						<div class="text-center py-5">
							<i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
							<h3 class="mb-3">Your cart is empty</h3>
							<p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
							<a href="{{ route('collection') }}" class="btn btn-primary btn-lg">
								<i class="fas fa-shopping-bag"></i> Continue Shopping
							</a>
						</div>
					@else
						<div class="cart-table">
							<table class="tables">
								<thead>	
									<tr>
										<th></th>
										<th>Image</th>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Unit Price</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cartItems as $item)
										<tr>
											<td>
												<form method="POST" action="{{ route('cart.remove', $item->id) }}" style="display:inline;">
													@csrf
													@method('DELETE')
													<button type="submit" style="background: none; border: none; color: #d9534f; font-size: 18px; cursor: pointer; padding: 0;">
														<i class="fas fa-times"></i>
													</button>
												</form>
											</td>
											<td>
												<a href="{{ route('product.show', $item->product->slug) }}">
													<div class="product-image">
														<img alt="{{ $item->product->name }}" 
															src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/cp1.jpg') }}">
													</div>
												</a>
											</td>
											<td>
												<div class="product-title">
													<a href="{{ route('product.show', $item->product->slug) }}">
														{{ $item->product->name }}
													</a>
												</div>
											</td>
											<td>
												<form method="POST" action="{{ route('cart.update', $item->id) }}" class="quantity-form">
													@csrf
													@method('PATCH')
													<div class="quantity">
														<input type="number" 
															name="quantity" 
															value="{{ $item->quantity }}" 
															min="1" 
															max="{{ $item->product->stock }}"
															onchange="this.form.submit()">
													</div>
												</form>
											</td>
											<td>
												<ul style="list-style: none; padding: 0;">
													<li>
														<div class="price-box">
															<span class="price">${{ number_format($item->product->final_price, 2) }}</span>
														</div>
													</li>
												</ul>
											</td>
											<td>
												<div class="total-price-box">
													<span class="price">${{ number_format($item->product->final_price * $item->quantity, 2) }}</span>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.cart-table -->
						<div class="row cart-btn-section">
							<div class="col-12">
					<div class="cart-btn-right" style="text-align: center; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
						<a href="{{ route('collection') }}" class="btn btn-secondary" style="padding: 15px 40px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
						 <span>Continue Shopping</span>
						</a>
						@auth
							<a href="{{ route('checkout') }}" class="checkout-btn-animated" style="background: #6c757d; color: white; padding: 15px 40px; text-decoration: none; border-radius: 5px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; text-align: center; line-height: 1; transition: all 0.4s ease; border: 2px solid transparent;">
								 <span>Checkout</span>
							</a>
						@else
							<a href="{{ route('login') }}" class="checkout-btn-animated" style="background:rgb(243, 168, 30); color: white; padding: 15px 40px; text-decoration: none; border-radius: 5px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; text-align: center; line-height: 1; transition: all 0.4s ease; border: 2px solid transparent;">
								 <span>Login to Checkout</span>
							</a>
						@endauth
					</div>
							</div>
						</div>
						<!-- /.row -->
					@endif
				</div>
				<!-- /.col-xl-9 -->
				<div class="col-xl-3">
					@if($cartItems->isNotEmpty())
						<div class="cart-subtotal">
							<p>ORDER SUMMARY</p>
							
							<!-- Product List -->
							<div class="order-items-list">
								@foreach($cartItems as $item)
									<div class="summary-item">
										<div class="item-details">
											<div class="item-name">{{ \Illuminate\Support\Str::limit($item->product->name, 25) }}</div>
											<div class="item-qty-price">{{ $item->quantity }} × ${{ number_format($item->product->final_price, 2) }}</div>
										</div>
										<div class="item-total">
											${{ number_format($item->product->final_price * $item->quantity, 2) }}
										</div>
									</div>
								@endforeach
							</div>

						<!-- Summary Totals -->
						<ul class="summary-totals">
							<li class="subtotal-line">
								<span>Subtotal:</span>
								<span>${{ number_format($subtotal, 2) }}</span>
							</li>
							<li class="total-line">
								<span>TOTAL:</span>
								<span>${{ number_format($subtotal + $shipping, 2) }}</span>
							</li>
						</ul>

					<!-- Checkout Button -->
					@auth
						<a href="{{ route('checkout') }}" class="checkout-button">
							<i class="fas fa-lock"></i>
							<span>Proceed To Checkout</span>
						</a>
					@else
						<a href="{{ route('login') }}" class="checkout-button">
							<span>Login to Checkout</span>
						</a>
					@endauth
						</div>
						<!-- /.cart-subtotal -->
					@endif
				</div>
				<!-- /.col-xl-3 -->
			</div>
		</div>
	</section>
	<!-- /.cart-area -->


		<!--=========================-->

@endsection

@push('styles')
<style>
	/* Enhanced Checkout Button Styles */
	.checkout-btn-main:hover,
	.checkout-btn-sidebar:hover {
		background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
		color: #000 !important;
		transform: translateY(-5px) scale(1.02);
		box-shadow: 0 12px 35px rgba(255, 215, 0, 0.7), 0 0 60px rgba(255, 215, 0, 0.3) !important;
		border-color: #000 !important;
	}
	
	/* Pulse animation for lock icon */
	@keyframes pulse {
		0%, 100% {
			transform: scale(1);
		}
		50% {
			transform: scale(1.1);
		}
	}
	
	/* Shine effect on button */
	.checkout-btn-main::before,
	.checkout-btn-sidebar::before {
		content: '';
		position: absolute;
		top: -50%;
		left: -50%;
		width: 200%;
		height: 200%;
		background: linear-gradient(
			45deg,
			transparent,
			rgba(255, 215, 0, 0.1),
			transparent
		);
		transform: rotate(45deg);
		animation: shine 3s infinite;
	}
	
	@keyframes shine {
		0% {
			left: -50%;
		}
		100% {
			left: 150%;
		}
	}

	/* Cart table enhancements */
	.cart-table .tables {
		width: 100%;
		border-collapse: collapse;
		background: white;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
		border-radius: 8px;
		overflow: hidden;
	}
	
	.cart-table .tables th,
	.cart-table .tables td {
		padding: 15px 10px;
		text-align: left;
		border-bottom: 1px solid #eee;
		vertical-align: middle;
	}
	
	.cart-table .tables th {
		background: #f8f9fa;
		font-weight: 600;
		color: #333;
		text-transform: uppercase;
		font-size: 12px;
		letter-spacing: 0.5px;
	}
	
	.cart-table .tables tbody tr {
		transition: background-color 0.3s ease;
	}
	
	.cart-table .tables tbody tr:hover {
		background: #f8f9fa;
	}
	
	.product-image img {
		width: 80px;
		height: 80px;
		object-fit: cover;
		border-radius: 8px;
		transition: transform 0.3s ease;
	}
	
	.product-image img:hover {
		transform: scale(1.1);
	}
	
	.product-title a {
		color: #333;
		text-decoration: none;
		font-weight: 500;
		transition: color 0.3s ease;
	}
	
	.product-title a:hover {
		color: #FFD700;
	}
	
	.quantity input {
		width: 70px;
		padding: 8px;
		border: 2px solid #ddd;
		border-radius: 4px;
		text-align: center;
		font-weight: 600;
		transition: border-color 0.3s ease;
	}
	
	.quantity input:focus {
		outline: none;
		border-color: #FFD700;
	}
	
	.price {
		font-weight: 600;
		color: #333;
		font-size: 16px;
	}

	/* Checkout button hover animation */
	.checkout-btn-animated:hover {
		background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
		color: #000 !important;
		transform: translateY(-3px) scale(1.05);
		box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4), 0 0 30px rgba(255, 215, 0, 0.2);
		border-color: #000 !important;
		text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
	}
	
	/* Cart summary styling */
	.cart-subtotal {
		background: white;
		padding: 25px;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0,0,0,0.08);
		border: 1px solid #f0f0f0;
	}
	
	.cart-subtotal > p {
		font-weight: 700;
		font-size: 18px;
		margin-bottom: 20px;
		color: #1a1a1a;
		text-transform: uppercase;
		letter-spacing: 1.5px;
		border-bottom: 2px solid #FFD700;
		padding-bottom: 12px;
	}
	
	/* Order Items List */
	.order-items-list {
		margin-bottom: 20px;
		max-height: 300px;
		overflow-y: auto;
		padding-right: 5px;
	}
	
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
	
	.summary-item {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		padding: 12px 0;
		border-bottom: 1px solid #f5f5f5;
		transition: background-color 0.2s ease;
	}
	
	.summary-item:hover {
		background-color: #fafafa;
		padding-left: 8px;
		margin-left: -8px;
		margin-right: -8px;
		padding-right: 8px;
		border-radius: 6px;
	}
	
	.summary-item:last-child {
		border-bottom: none;
	}
	
	.item-details {
		flex: 1;
		margin-right: 10px;
	}
	
	.item-name {
		font-weight: 600;
		color: #333;
		font-size: 13px;
		margin-bottom: 4px;
		line-height: 1.3;
	}
	
	.item-qty-price {
		font-size: 12px;
		color: #666;
		font-weight: 500;
	}
	
	.item-total {
		font-weight: 700;
		color: #1a1a1a;
		font-size: 14px;
		white-space: nowrap;
	}
	
	/* Summary Totals */
	.summary-totals {
		list-style: none;
		padding: 0;
		margin: 20px 0;
		border-top: 2px solid #f0f0f0;
		padding-top: 15px;
	}
	
	.summary-totals li {
		display: flex;
		justify-content: space-between;
		padding: 10px 0;
		font-size: 14px;
	}
	
	.subtotal-line {
		color: #666;
		font-weight: 500;
	}
	
	.subtotal-line span:last-child {
		color: #333;
		font-weight: 600;
	}
	
	.shipping-line {
		color: #666;
		font-weight: 500;
		border-bottom: 1px solid #f0f0f0;
		padding-bottom: 12px !important;
	}
	
	.shipping-line .text-success {
		color: #28a745 !important;
		font-weight: 700;
	}
	
	.total-line {
		border-top: 2px solid #1a1a1a;
		margin-top: 10px;
		padding-top: 15px !important;
		font-weight: 700 !important;
		font-size: 18px !important;
		color: #1a1a1a;
	}
	
	.total-line span {
		font-weight: 700;
	}
	
	.total-line span:last-child {
		color: #28a745;
		font-size: 20px;
		text-shadow: 0 1px 2px rgba(0,0,0,0.1);
	}
	
	/* Checkout Button */
	.checkout-button {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 8px;
		background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
		color: #FFD700;
		padding: 18px 30px;
		text-decoration: none;
		border-radius: 10px;
		font-weight: 700;
		font-size: 14px;
		text-transform: uppercase;
		letter-spacing: 1.5px;
		transition: all 0.3s ease;
		border: 2px solid #FFD700;
		text-align: center;
		box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
		margin-bottom: 15px;
	}
	
	.checkout-button:hover {
		background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
		text-decoration: none;
		border-color: #FFD700;
	}
	
	/* Cart Count Badge */
	.cart-count-badge {
		text-align: center;
		color: #666;
		font-size: 13px;
		font-weight: 500;
		padding: 12px;
		background: #f8f9fa;
		border-radius: 8px;
		border: 1px dashed #ddd;
	}
	
	.cart-count-badge i {
		color: #FFD700;
		margin-right: 5px;
	}
	
	/* Empty cart styling */
	.text-center.py-5 {
		background: white;
		border-radius: 8px;
		padding: 60px 20px !important;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	}
	
	/* Alert styling */
	.alert {
		border-radius: 8px;
		border: none;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		margin-bottom: 20px;
	}
	
	/* Remove button hover */
	.cart-table button[type="submit"]:hover {
		transform: scale(1.2);
		color: #c82333 !important;
	}
</style>
@endpush
