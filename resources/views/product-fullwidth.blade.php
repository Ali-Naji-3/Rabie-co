@extends('layouts.app')

@section('title', $product->name . ' - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{route('home')}}">Home</a> | <a href="{{route('collection')}}">Shop</a> | {{ $product->name }}</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--=        Product Details       =-->
		<section class="shop-area style-two">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<!-- Product Images -->
							<div class="col-lg-6 col-xl-6">
								<div class="quickview-slider">
									<!-- Main Image Slider -->
									<div class="slider-for">
										@if($product->primary_image)
											<div class="">
												<img src="{{ asset('storage/' . $product->primary_image) }}" 
													alt="{{ $product->name }}"
													loading="eager"
													style="max-width: 100%; height: auto;">
											</div>
										@endif
										@if($product->images)
											@foreach($product->images as $image)
												<div class="">
													<img src="{{ asset('storage/' . $image) }}" 
														alt="{{ $product->name }}"
														loading="lazy"
														style="max-width: 100%; height: auto;">
												</div>
											@endforeach
										@endif
										@if(!$product->primary_image && !$product->images)
											<div class="">
												<img src="{{ asset('media/images/product/single/b1.jpg') }}" alt="{{ $product->name }}">
											</div>
										@endif
									</div>

									<!-- Thumbnail Slider -->
									<div class="slider-nav">
										@if($product->primary_image)
											<div class="">
												<img src="{{ asset('storage/' . $product->primary_image) }}" alt="thumb">
											</div>
										@endif
										@if($product->images)
											@foreach($product->images as $image)
												<div class="">
													<img src="{{ asset('storage/' . $image) }}" alt="thumb">
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>

							<!-- Product Details -->
							<div class="col-lg-6 col-xl-6">
								<div class="product-details">
									<h5 class="pro-title">{{ $product->name }}</h5>
									
									<!-- Price -->
									<div class="price-section my-3">
										@if($product->discount_percentage > 0)
											@php
												$finalPrice = $product->sale_price;
												$savings = $product->price - $finalPrice;
											@endphp
											<div class="mb-2">
												<span style="color: #666; font-size: 16px;">Original Price: </span>
												<span style="color: #e74c3c; font-size: 22px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 2px;">
													${{ number_format($product->price, 2) }}
												</span>
												<span class="badge bg-danger ms-2" style="color: white;">{{ $product->discount_percentage }}% OFF</span>
											</div>
											<div class="mb-2">
												<span style="color: #666; font-size: 16px;">Final Price: </span>
												<span style="color: #27ae60; font-size: 36px; font-weight: bold; letter-spacing: 1px;">
													${{ number_format($finalPrice, 2) }}
												</span>
											</div>
										@else
											<div class="mb-2">
												<span style="color: #666; font-size: 16px;">Price: </span>
												<span style="color: #27ae60; font-size: 36px; font-weight: bold; letter-spacing: 1px;">
													${{ number_format($product->price, 2) }}
												</span>
											</div>
										@endif
									</div>


									<!-- Category & SKU -->
									<p>
										<strong>Category:</strong> {{ $product->category->name }}<br>
										@if($product->sku)
											<strong>SKU:</strong> {{ $product->sku }}
										@endif
									</p>

									<!-- Description -->
									<div class="my-4">
										{!! $product->description !!}
									</div>

									<!-- Add to Cart Form -->
									<form method="POST" action="{{ route('cart.add') }}" class="my-4">
										@csrf
										<input type="hidden" name="product_id" value="{{ $product->id }}">
										
										<div class="size-variation mb-3">
											<span>Quantity :</span>
											<input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="width: 80px; padding: 5px;">
										</div>

										@if($product->stock > 0)
											<button type="submit" class="btn btn-primary btn-lg">
												<i class="fa fa-shopping-cart"></i> Add to Cart
											</button>
										@else
											<button type="button" class="btn btn-secondary btn-lg" disabled>
												Out of Stock
											</button>
										@endif
									</form>

									<!-- Rating -->
									<div class="rating my-3" style="cursor: pointer;" onclick="document.getElementById('reviews-section').scrollIntoView({behavior: 'smooth'});">
										<span>Rating: </span>
										@php
											$avgRating = $product->reviews()->where('is_approved', true)->avg('rating') ?? 0;
											$reviewCount = $product->reviews()->where('is_approved', true)->count();
										@endphp
										@for($i = 1; $i <= 5; $i++)
											<i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}"></i>
										@endfor
									</div>

									
								</div>
							</div>
						</div>

						<!-- Product Reviews Section -->
						<div class="row mt-5" id="reviews-section">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between align-items-center">
										<div>
											<h4 class="mb-1">Customer Reviews </h4>
											
										</div>
										<div>
											@auth
												<a href="{{ route('review.create', $product->id) }}" 
												   class="btn btn-dark" 
												   style="background: #000000; 
												          color: #FFD700;
												          border: 2px solid #FFD700; 
												          padding: 12px 30px; 
												          font-size: 16px; 
												          font-weight: 700; 
												          border-radius: 8px; 
												          box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
												          transition: all 0.3s ease;
												          text-transform: uppercase;
												          letter-spacing: 1px;">
													<i class="fas fa-edit me-2" style="color: #FFD700;"></i> Review
												</a>
											@else
												<a href="{{ route('login') }}" 
												   class="btn btn-dark" 
												   style="background: #000000; 
												          color: #FFD700;
												          border: 2px solid #FFD700; 
												          padding: 12px 30px; 
												          font-size: 16px; 
												          font-weight: 700; 
												          border-radius: 8px; 
												          box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
												          transition: all 0.3s ease;
												          text-transform: uppercase;
												          letter-spacing: 1px;">
													<i class="fas fa-sign-in-alt me-2" style="color: #FFD700;"></i>Login to Write Review
												</a>
											@endauth
										</div>
									</div>
									<div class="card-body">
										@forelse($product->reviews()->where('is_approved', true)->orderBy('rating', 'desc')->latest()->take(5)->get() as $index => $review)
											<div class="review-item mb-4 p-4 border rounded" style="background-color: #f8f9fa; position: relative;">
												<!-- Top 5 Badge for each review -->
												<span class="badge position-absolute" style="top: 10px; right: 10px; background: #28a745; color: white; font-size: 10px; padding: 4px 8px;">
													#{{ $index + 1 }} Top Rated
												</span>
												
												@if($review->title)
													<h6 style="color: #2c3e50; font-weight: 600; margin-bottom: 8px;">{{ $review->title }}</h6>
												@endif
												<div class="d-flex justify-content-between align-items-start mb-3">
													<div>
														<strong style="color: #333; font-size: 16px;">{{ $review->user->name }}</strong>
														<div class="mt-1">
															@for($i = 1; $i <= 5; $i++)
																<i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 14px;"></i>
															@endfor
															<span class="ms-2 text-muted" style="font-size: 14px;">{{ $review->rating }}/5</span>
														</div>
													</div>
													<small class="text-muted" style="font-size: 12px;">{{ $review->created_at->format('M d, Y') }}</small>
												</div>
												<div class="review-comment">
													<p style="color: #555; line-height: 1.6; margin: 0;">{{ $review->comment }}</p>
												</div>
											</div>
										@empty
											<div class="text-center py-5">
												<i class="fas fa-comments fa-3x text-muted mb-3"></i>
												<h5 class="text-muted">No reviews yet</h5>
												<p class="text-muted">Be the first to review this product!</p>
											</div>
										@endforelse
									</div>
								</div>
							</div>
						</div>

						<!-- Related Products -->
						@if($relatedProducts->count() > 0)
						<div class="row mt-5">
							<div class="col-12">
								<h4 class="mb-4">Related Products</h4>
							</div>
							@foreach($relatedProducts as $related)
							<div class="col-sm-6 col-md-4 col-lg-3">
								<div class="sin-product style-two">
									<div class="pro-img">
										<a href="{{ route('product.show', $related->slug) }}">
											<img src="{{ $related->primary_image ? asset('storage/' . $related->primary_image) : asset('media/images/product/sp1.jpg') }}" alt="{{ $related->name }}">
										</a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title" style="font-size: 16px; font-weight: 900; color: #222; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
											<a href="{{ route('product.show', $related->slug) }}" style="color: #222; text-decoration: none; font-weight: 900;">{{ $related->name }}</a>
										</h5>
										<div class="price-section">
											@if($related->discount_percentage > 0)
												<div class="mb-1">
													<span style="color: #e74c3c; font-size: 14px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 2px;">
														${{ number_format($related->price, 2) }}
													</span>
												</div>
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 18px; font-weight: bold; letter-spacing: 0.5px;">
														${{ number_format($related->sale_price, 2) }}
													</span>
												</div>
											@else
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 18px; font-weight: bold; letter-spacing: 0.5px;">
														${{ number_format($related->price, 2) }}
													</span>
												</div>
											@endif
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						@endif
					</div>
				</div>
			</div>
		</section>

@endsection

@push('styles')
<style>
	/* Write Review Button Hover Effects - Black & Gold Theme */
	.btn-dark:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 25px rgba(255, 215, 0, 0.6) !important;
		background: #1a1a1a !important;
		border-color: #FFD700 !important;
	}
</style>
@endpush
