@extends('layouts.app')

@section('title', 'Order Successful - Softyskin Luxury')

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

		.success-section {
			background-color: var(--luxe-cream-bg);
			padding: 80px 0;
			min-height: 80vh;
			display: flex;
			align-items: center;
		}

		.success-badge-wrapper {
			margin-bottom: 30px;
			display: flex;
			justify-content: center;
		}

		.success-badge {
			width: 100px;
			height: 100px;
			background: var(--luxe-white);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
			border: 2px solid var(--luxe-primary-gold);
			color: var(--luxe-primary-gold);
			font-size: 40px;
		}

		.success-heading {
			font-family: 'Cormorant Garamond', serif;
			font-size: 48px;
			font-weight: 700;
			color: var(--luxe-black);
			margin-bottom: 15px;
		}

		.success-subtitle {
			font-size: 18px;
			color: var(--luxe-text-gray);
			margin-bottom: 50px;
			max-width: 600px;
			margin-left: auto;
			margin-right: auto;
			line-height: 1.6;
		}

		.luxe-card {
			background: var(--luxe-white);
			border-radius: 24px;
			padding: 40px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.05);
			border: 1px solid var(--luxe-soft-border);
			text-align: left;
		}

		.card-title {
			font-family: 'Cormorant Garamond', serif;
			font-size: 24px;
			font-weight: 700;
			color: var(--luxe-black);
			margin-bottom: 25px;
			display: flex;
			align-items: center;
			gap: 12px;
		}

		.card-title i {
			color: var(--luxe-primary-gold);
			font-size: 20px;
		}

		/* Status Pill */
		.status-pill {
			background: #F5F1EA;
			color: #C9A15B;
			padding: 6px 16px;
			border-radius: 30px;
			font-size: 13px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}

		/* Detail Grid */
		.detail-grid {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 24px;
		}

		.detail-item label {
			display: block;
			font-size: 13px;
			color: var(--luxe-text-gray);
			margin-bottom: 4px;
			font-weight: 600;
		}

		.detail-item span {
			font-size: 16px;
			color: var(--luxe-black);
			font-weight: 700;
		}

		/* Success Item list */
		.ordered-item {
			display: flex;
			align-items: center;
			gap: 20px;
			padding: 20px 0;
			border-bottom: 1px solid var(--luxe-soft-border);
		}

		.ordered-item:last-child {
			border-bottom: none;
		}

		.ordered-item-img {
			width: 100px;
			height: 100px;
			border-radius: 14px;
			object-fit: cover;
			background: var(--luxe-cream-bg);
		}

		.ordered-item-info h4 {
			font-family: 'Cormorant Garamond', serif;
			font-size: 18px;
			font-weight: 700;
			color: var(--luxe-black);
			margin: 0;
		}

		.ordered-item-info p {
			font-size: 14px;
			color: var(--luxe-text-gray);
			margin: 4px 0 0 0;
		}

		/* Buttons */
		.btn-luxe-dark {
			background: var(--luxe-black);
			color: #fff;
			padding: 18px 40px;
			border-radius: 14px;
			font-weight: 700;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			display: inline-flex;
			align-items: center;
			gap: 12px;
			transition: all 0.25s ease;
			border: none;
		}

		.btn-luxe-dark:hover {
			background: #000;
			transform: translateY(-2px);
			color: #fff;
			text-decoration: none;
		}

		.btn-luxe-outline {
			background: transparent;
			color: var(--luxe-black);
			padding: 16px 38px;
			border-radius: 14px;
			font-weight: 700;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			display: inline-flex;
			align-items: center;
			gap: 12px;
			transition: all 0.25s ease;
			border: 2px solid var(--luxe-primary-gold);
		}

		.btn-luxe-outline:hover {
			background: var(--luxe-primary-gold);
			color: #fff;
			transform: translateY(-2px);
			text-decoration: none;
		}

		@media (max-width: 768px) {
			.success-heading { font-size: 36px; }
			.detail-grid { grid-template-columns: 1fr; gap: 15px; }
			.luxe-card { padding: 30px 20px; }
			.action-buttons { flex-direction: column; width: 100%; }
			.btn-luxe-dark, .btn-luxe-outline { width: 100%; justify-content: center; }
		}
	</style>

	<section class="success-section">
		<div class="container custom-container text-center">
			
			<div class="success-badge-wrapper reveal">
				<div class="success-badge">
					<i class="fa fa-check"></i>
				</div>
			</div>

			<h1 class="success-heading reveal luxe-serif">Thank You For Your Order</h1>
			<p class="success-subtitle reveal luxe-sans">Your order has been received and is now being prepared. We'll send you a confirmation email shortly.</p>

			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="luxe-card reveal mb-5">
						<h3 class="card-title"><i class="fa fa-file-invoice"></i> Order Details</h3>
						
						<div class="detail-grid">
							<div class="detail-item">
								<label>Order Number</label>
								<span>#{{ $order->order_number }}</span>
							</div>
							<div class="detail-item">
								<label>Order Date</label>
								<span>{{ $order->created_at->format('M d, Y') }}</span>
							</div>
							<div class="detail-item">
								<label>Payment Method</label>
								<span>
									@if($order->payment_method == 'cod') Cash On Delivery @else {{ strtoupper($order->payment_method) }} @endif
								</span>
							</div>
							<div class="detail-item">
								<label>Order Status</label>
								<div>
									<span class="status-pill">Pending</span>
								</div>
							</div>
							<div class="detail-item pt-2">
								<label>Total Amount</label>
								<span class="luxe-gold-text" style="font-size: 20px;">@price($order->total)</span>
							</div>
						</div>
					</div>

					<div class="luxe-card reveal">
						<h3 class="card-title"><i class="fa fa-shopping-bag"></i> Ordered Items ({{ $order->items->count() }})</h3>
						
						<div class="ordered-items-list">
							@foreach($order->items as $item)
								<div class="ordered-item">
									<img src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/cp1.jpg') }}" alt="{{ $item->product->name }}" class="ordered-item-img">
									<div class="ordered-item-info flex-grow-1">
										<h4 class="luxe-serif">{{ $item->product->name }}</h4>
										<p>Quantity: {{ $item->quantity }}</p>
									</div>
									<div class="font-weight-bold luxe-black">@price($item->subtotal)</div>
								</div>
							@endforeach
						</div>
					</div>

					<div class="action-buttons d-flex justify-content-center gap-3 mt-5 reveal">
						<a href="{{ route('orders.index') }}" class="btn-luxe-dark">
							<i class="fa fa-list-ul"></i> View My Orders
						</a>
						<a href="{{ route('collection') }}" class="btn-luxe-outline">
							<i class="fa fa-shopping-bag"></i> Continue Shopping
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection