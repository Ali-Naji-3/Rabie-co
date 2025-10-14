@extends('layouts.app')

@section('title', 'Order Success - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{ url('/') }}">Home</a> | <a href="{{ route('collection') }}">Shop</a> | Order Success</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Order Success        =-->
		<!--=========================-->

		<section class="order-success-area" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
			<div class="container-fluid custom-container">
				<div class="row justify-content-center">
					<div class="col-xl-8 col-lg-10">
						
						<!-- Success Message -->
						<div class="success-card" style="background: #fff; border-radius: 20px; padding: 60px 40px; text-align: center; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1); border: 3px solid #FFD700; position: relative; overflow: hidden;">
							
							<!-- Success Icon -->
							<div class="success-icon" style="margin-bottom: 30px;">
								<div style="width: 120px; height: 120px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3); animation: successPulse 2s infinite;">
									<i class="fas fa-check" style="font-size: 60px; color: #fff; font-weight: 900;"></i>
								</div>
							</div>

							<!-- Success Message -->
							<h1 style="color: #333; font-size: 48px; font-weight: 900; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px;">
								Order Successful!
							</h1>
							
							<p style="color: #666; font-size: 20px; margin-bottom: 40px; line-height: 1.6;">
								Thank you for your purchase! Your order has been confirmed and will be processed shortly.
							</p>

							<!-- Order Details -->
							@if(isset($order))
							<div class="order-details" style="background: #f8f9fa; border-radius: 15px; padding: 30px; margin: 40px 0; border-left: 5px solid #FFD700;">
								<h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">
									<i class="fas fa-receipt" style="color: #FFD700; margin-right: 10px;"></i>
									Order Details
								</h3>
								
								<div class="row">
									<div class="col-md-6">
										<div class="detail-item" style="margin-bottom: 15px;">
											<strong style="color: #333; font-size: 16px;">Order Number:</strong>
											<span style="color: #666; font-size: 16px; margin-left: 10px; font-family: monospace; background: #e9ecef; padding: 5px 10px; border-radius: 5px;">#{{ $order->order_number }}</span>
										</div>
										<div class="detail-item" style="margin-bottom: 15px;">
											<strong style="color: #333; font-size: 16px;">Order Date:</strong>
											<span style="color: #666; font-size: 16px; margin-left: 10px;">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</span>
										</div>
									</div>
							<div class="col-md-6">
								<div class="detail-item" style="margin-bottom: 15px;">
									<strong style="color: #333; font-size: 16px;">Payment Method:</strong>
									<span style="color: #666; font-size: 16px; margin-left: 10px; text-transform: capitalize;">
										@if($order->payment_method == 'cod')
											Cash on Delivery
										@elseif($order->payment_method == 'card')
											Credit/Debit Card
										@elseif($order->payment_method == 'bank_transfer')
											Bank Transfer
										@else
											{{ $order->payment_method }}
										@endif
									</span>
								</div>
								<div class="detail-item" style="margin-bottom: 15px;">
									<strong style="color: #333; font-size: 16px;">Payment Status:</strong>
									<span style="margin-left: 10px; padding: 5px 12px; border-radius: 20px; font-size: 14px; font-weight: 600; text-transform: uppercase;
										@if($order->payment_status == 'paid')
											background: #d4edda; color: #155724;
										@elseif($order->payment_status == 'pending')
											background: #fff3cd; color: #856404;
										@elseif($order->payment_status == 'failed')
											background: #f8d7da; color: #721c24;
										@elseif($order->payment_status == 'refunded')
											background: #d1ecf1; color: #0c5460;
										@else
											background: #e2e3e5; color: #383d41;
										@endif
									">
										{{ ucfirst($order->payment_status) }}
									</span>
								</div>
								<div class="detail-item" style="margin-bottom: 15px;">
									<strong style="color: #333; font-size: 16px;">Total Amount:</strong>
									<span style="color: #28a745; font-size: 18px; font-weight: 700; margin-left: 10px;">${{ number_format($order->total, 2) }}</span>
								</div>
							</div>
								</div>
							</div>
							@endif

							<!-- Order Items Summary -->
							@if(isset($order) && $order->items->count() > 0)
							<div class="order-items" style="background: #fff; border-radius: 15px; padding: 30px; margin: 30px 0; border: 2px solid #e9ecef;">
								<h4 style="color: #333; font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">
									<i class="fas fa-shopping-bag" style="color: #FFD700; margin-right: 10px;"></i>
									Ordered Items ({{ $order->items->count() }})
								</h4>
								
								<div class="items-list">
									@foreach($order->items as $item)
									<div class="item-row" style="display: flex; align-items: center; padding: 15px 0; border-bottom: 1px solid #f1f3f4;">
										<div class="item-image" style="width: 80px; height: 80px; margin-right: 20px;">
											<img src="{{ $item->product->primary_image ? Storage::url($item->product->primary_image) : 'media/images/product/cp1.jpg' }}" 
												 alt="{{ $item->product->name }}" 
												 style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px; border: 2px solid #e9ecef;">
										</div>
										<div class="item-details" style="flex: 1;">
											<h5 style="color: #333; font-size: 16px; font-weight: 600; margin-bottom: 5px;">{{ $item->product->name }}</h5>
											<p style="color: #666; font-size: 14px; margin-bottom: 5px;">Quantity: {{ $item->quantity }}</p>
											<p style="color: #28a745; font-size: 16px; font-weight: 700;">${{ number_format($item->subtotal, 2) }}</p>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@endif

						<!-- Action Buttons -->
							<div class="action-buttons" style="margin-top: 40px;">
								<div class="row">
									<div class="col-md-6 mb-3">
										<a href="{{ route('orders.index') }}" 
										   style="display: block; background: #000; color: #FFD700; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #000; text-align: center;"
										   onmouseover="this.style.background='#FFD700'; this.style.color='#000'; this.style.borderColor='#000'"
										   onmouseout="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#000'">
											<i class="fas fa-list-alt" style="margin-right: 10px;"></i>
											View My Orders
										</a>
									</div>
									<div class="col-md-6 mb-3">
										<a href="{{ route('collection') }}" 
										   style="display: block; background: #FFD700; color: #000; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #FFD700; text-align: center;"
										   onmouseover="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#FFD700'"
										   onmouseout="this.style.background='#FFD700'; this.style.color='#000'; this.style.borderColor='#FFD700'">
											<i class="fas fa-shopping-bag" style="margin-right: 10px;"></i>
											Continue Shopping
										</a>
									</div>
								</div>
							</div>

						</div>
						<!-- /.success-card -->

					</div>
					<!-- /.col-xl-8 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
		<!-- /.order-success-area -->

		<!--=========================-->

@endsection

@push('styles')
<style>
	/* Success animation */
	@keyframes successPulse {
		0%, 100% {
			transform: scale(1);
			box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
		}
		50% {
			transform: scale(1.05);
			box-shadow: 0 15px 40px rgba(40, 167, 69, 0.5);
		}
	}

	/* Success card shine effect */
	.success-card::before {
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
		animation: shine 4s infinite;
		pointer-events: none;
	}

	@keyframes shine {
		0% {
			left: -50%;
		}
		100% {
			left: 150%;
		}
	}

	/* Responsive design */
	@media (max-width: 768px) {
		.success-card {
			padding: 40px 20px !important;
			margin: 20px 10px !important;
		}
		
		h1 {
			font-size: 36px !important;
		}
		
		.success-icon div {
			width: 100px !important;
			height: 100px !important;
		}
		
		.success-icon i {
			font-size: 50px !important;
		}
	}

	/* Item row hover effect */
	.item-row:hover {
		background: #f8f9fa;
		border-radius: 8px;
		transition: all 0.3s ease;
	}
</style>
@endpush