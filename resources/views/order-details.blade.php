@extends('layouts.app')

@section('title', 'Order Details - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{ url('/') }}">Home</a> | <a href="{{ route('orders.index') }}">My Orders</a> | Order Details</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Order Details        =-->
		<!--=========================-->

		<section class="order-details-area" style="padding: 60px 0; background: #f8f9fa;">
			<div class="container-fluid custom-container">
				
				<!-- Order Header -->
				<div class="row">
					<div class="col-12">
						<div class="order-header-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #FFD700;">
							<div class="row align-items-center">
								<div class="col-md-8">
									<h1 style="color: #333; font-size: 36px; font-weight: 900; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px;">
										Order #{{ $order->order_number }}
									</h1>
									<p style="color: #666; font-size: 16px; margin-bottom: 0;">
										Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
									</p>
								</div>
								<div class="col-md-4 text-md-end">
									<span class="status-badge status-{{ $order->status }}" 
										  style="padding: 12px 25px; border-radius: 25px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; display: inline-block;">
										{{ ucfirst($order->status) }}
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<!-- Order Items -->
					<div class="col-xl-8">
						<div class="order-items-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">
								<i class="fas fa-shopping-bag" style="color: #FFD700; margin-right: 10px;"></i>
								Order Items ({{ $order->items->count() }})
							</h3>
							
							<div class="items-list">
								@foreach($order->items as $item)
								<div class="item-detail-row" style="display: flex; align-items: center; padding: 20px 0; border-bottom: 1px solid #f1f3f4;">
									<div class="item-image" style="width: 100px; height: 100px; margin-right: 25px;">
										<img src="{{ $item->product->primary_image ? Storage::url($item->product->primary_image) : 'media/images/product/cp1.jpg' }}" 
											 alt="{{ $item->product->name }}" 
											 style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; border: 3px solid #fff; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);">
									</div>
									<div class="item-details" style="flex: 1;">
										<h4 style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 8px;">
											<a href="{{ route('product.show', $item->product->slug) }}" style="color: #333; text-decoration: none;">
												{{ $item->product->name }}
											</a>
										</h4>
										<p style="color: #666; font-size: 14px; margin-bottom: 5px;">
											SKU: {{ $item->product->sku ?? 'N/A' }}
										</p>
										<div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
											<div class="quantity-info">
												<span style="color: #666; font-size: 14px;">Quantity:</span>
												<strong style="color: #333; font-size: 16px; margin-left: 5px;">{{ $item->quantity }}</strong>
											</div>
											<div class="price-info">
												<span style="color: #666; font-size: 14px;">Unit Price:</span>
												<span style="color: #333; font-size: 16px; font-weight: 600; margin-left: 5px;">${{ number_format($item->price, 2) }}</span>
											</div>
											<div class="total-info">
												<span style="color: #666; font-size: 14px;">Subtotal:</span>
												<span style="color: #28a745; font-size: 18px; font-weight: 700; margin-left: 5px;">${{ number_format($item->subtotal, 2) }}</span>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<!-- Order Summary & Details -->
					<div class="col-xl-4">
						<!-- Order Summary -->
						<div class="order-summary-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<h3 style="color: #333; font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">
								<i class="fas fa-calculator" style="color: #FFD700; margin-right: 8px;"></i>
								Order Summary
							</h3>
							
							<div class="summary-items" style="margin-bottom: 20px;">
								<div class="summary-row" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f3f4;">
									<span style="color: #666; font-size: 14px;">Subtotal:</span>
									<span style="color: #333; font-size: 14px; font-weight: 600;">${{ number_format($order->subtotal, 2) }}</span>
								</div>
								<div class="summary-row" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f3f4;">
									<span style="color: #666; font-size: 14px;">Shipping:</span>
									<span style="color: #333; font-size: 14px; font-weight: 600;">${{ number_format($order->shipping, 2) }}</span>
								</div>
								<div class="summary-row" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f3f4;">
									<span style="color: #666; font-size: 14px;">Tax:</span>
									<span style="color: #333; font-size: 14px; font-weight: 600;">${{ number_format($order->tax, 2) }}</span>
								</div>
								<div class="summary-row" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-top: 2px solid #FFD700; margin-top: 10px;">
									<span style="color: #333; font-size: 18px; font-weight: 700;">Total:</span>
									<span style="color: #28a745; font-size: 20px; font-weight: 900;">${{ number_format($order->total, 2) }}</span>
								</div>
							</div>
						</div>

						<!-- Payment Information -->
						<div class="payment-info-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<h3 style="color: #333; font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">
								<i class="fas fa-credit-card" style="color: #FFD700; margin-right: 8px;"></i>
								Payment Information
							</h3>
							
							<div class="payment-details">
								<div class="payment-row" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f3f4;">
									<span style="color: #666; font-size: 14px;">Payment Method:</span>
									<span style="color: #333; font-size: 14px; font-weight: 600; text-transform: capitalize;">
										{{ str_replace('_', ' ', $order->payment_method) }}
									</span>
								</div>
								<div class="payment-row" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0;">
									<span style="color: #666; font-size: 14px;">Payment Status:</span>
									<span class="payment-status payment-{{ $order->payment_status }}" 
										  style="padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
										{{ ucfirst($order->payment_status) }}
									</span>
								</div>
							</div>
						</div>

						<!-- Shipping Address -->
						@php
							$shippingAddress = is_string($order->shipping_address) ? json_decode($order->shipping_address, true) : $order->shipping_address;
						@endphp
						
						@if($shippingAddress)
						<div class="shipping-info-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<h3 style="color: #333; font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">
								<i class="fas fa-shipping-fast" style="color: #FFD700; margin-right: 8px;"></i>
								Shipping Address
							</h3>
							
							<div class="address-details" style="color: #666; font-size: 14px; line-height: 1.6;">
								<p style="margin-bottom: 5px; font-weight: 600; color: #333;">{{ $shippingAddress['name'] ?? '' }}</p>
								<p style="margin-bottom: 5px;">{{ $shippingAddress['address'] ?? '' }}</p>
								@if(isset($shippingAddress['address_2']) && $shippingAddress['address_2'])
								<p style="margin-bottom: 5px;">{{ $shippingAddress['address_2'] }}</p>
								@endif
								<p style="margin-bottom: 5px;">
									{{ $shippingAddress['city'] ?? '' }}, {{ $shippingAddress['state'] ?? '' }} {{ $shippingAddress['postal_code'] ?? '' }}
								</p>
								<p style="margin-bottom: 0;">{{ $shippingAddress['country'] ?? '' }}</p>
								@if(isset($shippingAddress['phone']) && $shippingAddress['phone'])
								<p style="margin-bottom: 0; margin-top: 10px; font-weight: 600; color: #333;">
									<i class="fas fa-phone" style="margin-right: 5px;"></i>
									{{ $shippingAddress['phone'] }}
								</p>
								@endif
							</div>
						</div>
						@endif

						<!-- Order Notes -->
						@if($order->notes)
						<div class="order-notes-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<h3 style="color: #333; font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">
								<i class="fas fa-sticky-note" style="color: #FFD700; margin-right: 8px;"></i>
								Order Notes
							</h3>
							<p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 0;">
								{{ $order->notes }}
							</p>
						</div>
						@endif

					</div>
				</div>

				<!-- Action Buttons -->
				<div class="row">
					<div class="col-12">
						<div class="action-buttons" style="text-align: center; margin-top: 40px;">
							<a href="{{ route('orders.index') }}" 
							   style="display: inline-block; background: #000; color: #FFD700; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #000; margin-right: 15px;"
							   onmouseover="this.style.background='#FFD700'; this.style.color='#000'; this.style.borderColor='#000'"
							   onmouseout="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#000'">
								<i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
								Back to Orders
							</a>
							
							@if($order->status === 'delivered')
							<a href="{{ route('product.show', $order->items->first()->product->slug) }}" 
							   style="display: inline-block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #000; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #FFD700;"
							   onmouseover="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#FFD700'"
							   onmouseout="this.style.background='linear-gradient(135deg, #FFD700 0%, #FFA500 100%)'; this.style.color='#000'; this.style.borderColor='#FFD700'">
								<i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
								Buy Again
							</a>
							@endif
						</div>
					</div>
				</div>

			</div>
		</section>
		<!-- /.order-details-area -->

		<!--=========================-->

@endsection

@push('styles')
<style>
	/* Status Badge Colors */
	.status-pending {
		background: #fff3cd;
		color: #856404;
		border: 1px solid #ffeaa7;
	}
	
	.status-processing {
		background: #d1ecf1;
		color: #0c5460;
		border: 1px solid #bee5eb;
	}
	
	.status-shipped {
		background: #cce5ff;
		color: #004085;
		border: 1px solid #b3d7ff;
	}
	
	.status-delivered {
		background: #d4edda;
		color: #155724;
		border: 1px solid #c3e6cb;
	}
	
	.status-cancelled {
		background: #f8d7da;
		color: #721c24;
		border: 1px solid #f5c6cb;
	}

	/* Payment Status Colors */
	.payment-pending {
		background: #fff3cd;
		color: #856404;
	}
	
	.payment-paid {
		background: #d4edda;
		color: #155724;
	}
	
	.payment-failed {
		background: #f8d7da;
		color: #721c24;
	}
	
	.payment-refunded {
		background: #e2e3e5;
		color: #383d41;
	}

	/* Card Hover Effects */
	.order-header-card:hover,
	.order-items-card:hover,
	.order-summary-card:hover,
	.payment-info-card:hover,
	.shipping-info-card:hover,
	.order-notes-card:hover {
		transform: translateY(-2px);
		transition: all 0.3s ease;
	}

	/* Item Detail Row Hover */
	.item-detail-row:hover {
		background: #f8f9fa;
		border-radius: 10px;
		transition: all 0.3s ease;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		h1 {
			font-size: 28px !important;
		}
		
		.order-header-card .row {
			text-align: center !important;
		}
		
		.col-md-4.text-md-end {
			text-align: center !important;
			margin-top: 20px;
		}
		
		.action-buttons a {
			display: block !important;
			margin-bottom: 15px !important;
			margin-right: 0 !important;
		}
		
		.item-detail-row {
			flex-direction: column !important;
			text-align: center;
		}
		
		.item-image {
			margin-right: 0 !important;
			margin-bottom: 20px !important;
		}
	}
</style>
@endpush
