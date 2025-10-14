@extends('layouts.app')

@section('title', 'My Orders - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{ url('/') }}">Home</a> | <a href="{{ route('collection') }}">Shop</a> | My Orders</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        My Orders        =-->
		<!--=========================-->

		<section class="my-orders-area" style="padding: 60px 0; background: #f8f9fa;">
			<div class="container-fluid custom-container">
				
				<!-- Page Header -->
				<div class="row">
					<div class="col-12">
						<div class="page-header" style="text-align: center; margin-bottom: 50px;">
							<h1 style="color: #333; font-size: 42px; font-weight: 900; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 2px;">
								My Orders
							</h1>
							<p style="color: #666; font-size: 18px; margin-bottom: 0;">
								Track and manage your orders
							</p>
						</div>
					</div>
				</div>

				<!-- Orders List -->
				<div class="row">
					<div class="col-12">
						@forelse($orders as $order)
						<div class="order-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #FFD700; transition: all 0.3s ease;">
							
							<!-- Order Header -->
							<div class="order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
								<div class="order-info">
									<h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 5px;">
										Order #{{ $order->order_number }}
									</h3>
									<p style="color: #666; font-size: 14px; margin-bottom: 0;">
										Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
									</p>
								</div>
								<div class="order-status">
									<span class="status-badge status-{{ $order->status }}" 
										  style="padding: 8px 20px; border-radius: 25px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
										{{ ucfirst($order->status) }}
									</span>
								</div>
							</div>

							<!-- Order Items -->
							<div class="order-items" style="margin-bottom: 25px;">
								<h4 style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 15px;">
									<i class="fas fa-shopping-bag" style="color: #FFD700; margin-right: 8px;"></i>
									Order Items ({{ $order->items->count() }})
								</h4>
								
								<div class="items-grid" style="display: grid; gap: 15px;">
									@foreach($order->items as $item)
									<div class="item-row" style="display: flex; align-items: center; padding: 15px; background: #f8f9fa; border-radius: 10px; border: 1px solid #e9ecef;">
										<div class="item-image" style="width: 80px; height: 80px; margin-right: 20px;">
											<img src="{{ $item->product->primary_image ? Storage::url($item->product->primary_image) : 'media/images/product/cp1.jpg' }}" 
												 alt="{{ $item->product->name }}" 
												 style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px; border: 2px solid #fff;">
										</div>
										<div class="item-details" style="flex: 1;">
											<h5 style="color: #333; font-size: 16px; font-weight: 600; margin-bottom: 5px;">
												<a href="{{ route('product.show', $item->product->slug) }}" style="color: #333; text-decoration: none;">
													{{ $item->product->name }}
												</a>
											</h5>
											<p style="color: #666; font-size: 14px; margin-bottom: 5px;">
												Quantity: <strong>{{ $item->quantity }}</strong>
											</p>
											<p style="color: #28a745; font-size: 16px; font-weight: 700; margin-bottom: 0;">
												${{ number_format($item->subtotal, 2) }}
											</p>
										</div>
									</div>
									@endforeach
								</div>
							</div>

							<!-- Order Summary -->
							<div class="order-summary" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 10px; padding: 20px; margin-bottom: 25px;">
								<div class="row">
									<div class="col-md-6">
										<div class="summary-item" style="margin-bottom: 10px;">
											<span style="color: #666; font-size: 14px;">Payment Method:</span>
											<strong style="color: #333; font-size: 14px; margin-left: 10px; text-transform: capitalize;">
												{{ str_replace('_', ' ', $order->payment_method) }}
											</strong>
										</div>
										<div class="summary-item" style="margin-bottom: 10px;">
											<span style="color: #666; font-size: 14px;">Payment Status:</span>
											<span class="payment-status payment-{{ $order->payment_status }}" 
												  style="margin-left: 10px; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
												{{ ucfirst($order->payment_status) }}
											</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="summary-item" style="margin-bottom: 10px;">
											<span style="color: #666; font-size: 14px;">Subtotal:</span>
											<span style="color: #333; font-size: 14px; margin-left: 10px;">${{ number_format($order->subtotal, 2) }}</span>
										</div>
										<div class="summary-item" style="margin-bottom: 10px;">
											<span style="color: #666; font-size: 14px;">Shipping:</span>
											<span style="color: #333; font-size: 14px; margin-left: 10px;">${{ number_format($order->shipping, 2) }}</span>
										</div>
										<div class="summary-item" style="margin-bottom: 0;">
											<span style="color: #666; font-size: 16px; font-weight: 600;">Total:</span>
											<span style="color: #28a745; font-size: 18px; font-weight: 700; margin-left: 10px;">${{ number_format($order->total, 2) }}</span>
										</div>
									</div>
								</div>
							</div>

							<!-- Order Actions -->
							<div class="order-actions" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
								<div class="action-buttons">
									<a href="{{ route('orders.show', $order->id) }}" 
									   style="display: inline-block; background: #000; color: #FFD700; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #000;"
									   onmouseover="this.style.background='#FFD700'; this.style.color='#000'; this.style.borderColor='#000'"
									   onmouseout="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#000'">
										<i class="fas fa-eye" style="margin-right: 8px;"></i>
										View Details
									</a>
									
									@if($order->status === 'delivered')
									<a href="{{ route('product.show', $order->items->first()->product->slug) }}" 
									   style="display: inline-block; background: #28a745; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #28a745; margin-left: 10px;"
									   onmouseover="this.style.background='#fff'; this.style.color='#28a745'; this.style.borderColor='#28a745'"
									   onmouseout="this.style.background='#28a745'; this.style.color='#fff'; this.style.borderColor='#28a745'">
										<i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
										Buy Again
									</a>
									@endif
								</div>
								
								<div class="order-total-mobile" style="display: none;">
									<span style="color: #28a745; font-size: 20px; font-weight: 700;">${{ number_format($order->total, 2) }}</span>
								</div>
							</div>

						</div>
						@empty
						<div class="empty-orders" style="text-align: center; padding: 80px 20px; background: #fff; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
							<div class="empty-icon" style="margin-bottom: 30px;">
								<i class="fas fa-shopping-bag" style="font-size: 80px; color: #ccc;"></i>
							</div>
							<h3 style="color: #666; font-size: 28px; font-weight: 600; margin-bottom: 15px;">
								No Orders Yet
							</h3>
							<p style="color: #999; font-size: 16px; margin-bottom: 30px;">
								You haven't placed any orders yet. Start shopping to see your orders here!
							</p>
							<a href="{{ route('collection') }}" 
							   style="display: inline-block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #000; padding: 15px 40px; text-decoration: none; border-radius: 10px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; transition: all 0.3s ease; border: 2px solid #FFD700;"
							   onmouseover="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#000'"
							   onmouseout="this.style.background='linear-gradient(135deg, #FFD700 0%, #FFA500 100%)'; this.style.color='#000'; this.style.borderColor='#FFD700'">
								<i class="fas fa-shopping-bag" style="margin-right: 10px;"></i>
								Start Shopping
							</a>
						</div>
						@endforelse
					</div>
				</div>

				<!-- Pagination -->
				@if($orders->hasPages())
				<div class="row">
					<div class="col-12">
						<div class="pagination-wrapper" style="text-align: center; margin-top: 40px;">
							{{ $orders->links() }}
						</div>
					</div>
				</div>
				@endif

			</div>
		</section>
		<!-- /.my-orders-area -->

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

	/* Order Card Hover Effect */
	.order-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
	}

	/* Item Row Hover Effect */
	.item-row:hover {
		background: #e9ecef !important;
		transform: translateX(5px);
		transition: all 0.3s ease;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.order-header {
			flex-direction: column !important;
			align-items: flex-start !important;
		}
		
		.order-actions {
			flex-direction: column !important;
			align-items: stretch !important;
		}
		
		.action-buttons {
			display: flex;
			flex-direction: column;
			gap: 10px;
		}
		
		.action-buttons a {
			text-align: center;
			margin-left: 0 !important;
		}
		
		.order-total-mobile {
			display: block !important;
			text-align: center;
			margin-top: 15px;
		}
		
		h1 {
			font-size: 32px !important;
		}
		
		.page-header {
			margin-bottom: 30px !important;
		}
	}

	/* Pagination Styling */
	.pagination {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 10px;
		margin: 0;
		padding: 0;
		list-style: none;
	}
	
	.pagination li {
		display: inline-block;
	}
	
	.pagination a {
		display: inline-block;
		padding: 10px 15px;
		background: #fff;
		color: #333;
		text-decoration: none;
		border-radius: 8px;
		border: 2px solid #e9ecef;
		transition: all 0.3s ease;
		font-weight: 600;
	}
	
	.pagination a:hover,
	.pagination .active a {
		background: #FFD700;
		color: #000;
		border-color: #FFD700;
		transform: translateY(-2px);
	}
</style>
@endpush
