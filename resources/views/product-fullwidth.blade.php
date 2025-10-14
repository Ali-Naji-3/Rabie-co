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
									<span class="price">
										@if($product->sale_price)
											<del style="color: #999; font-size: 18px;">${{ number_format($product->price, 2) }}</del>
											<span style="color: #e74c3c; font-size: 24px; font-weight: bold;"> ${{ number_format($product->sale_price, 2) }}</span>
											<span class="badge bg-success ms-2">SAVE ${{ number_format($product->price - $product->sale_price, 2) }}</span>
										@else
											Price : ${{ number_format($product->price, 2) }}
										@endif
									</span>

									<!-- Stock Status -->
									<div class="my-3">
										@if($product->stock > 0)
											<span class="badge bg-success">✓ In Stock ({{ $product->stock }} available)</span>
										@else
											<span class="badge bg-danger">✗ Out of Stock</span>
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
									<div class="rating my-3">
										<span>Rating: </span>
										@php
											$avgRating = $product->reviews()->where('is_approved', true)->avg('rating') ?? 0;
											$reviewCount = $product->reviews()->where('is_approved', true)->count();
										@endphp
										@for($i = 1; $i <= 5; $i++)
											<i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}"></i>
										@endfor
										<span>({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
									</div>

									<!-- Social Share -->
									<div class="pro-social">
										<span>Share :</span>
										<ul>
											<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<!-- Product Reviews Section -->
						<div class="row mt-5">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Customer Reviews ({{ $reviewCount }})</h4>
										@auth
											<a href="{{ route('review.create', $product->id) }}" class="btn btn-primary btn-sm float-end">Write a Review</a>
										@else
											<a href="{{ route('login') }}" class="btn btn-primary btn-sm float-end">Login to Write Review</a>
										@endauth
									</div>
									<div class="card-body">
										@forelse($product->reviews()->where('is_approved', true)->latest()->get() as $review)
											<div class="mb-3 p-3 border-bottom">
												<div class="d-flex justify-content-between">
													<strong>{{ $review->user->name }}</strong>
													<small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
												</div>
												<div class="my-2">
													@for($i = 1; $i <= 5; $i++)
														<i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
													@endfor
												</div>
												<p>{{ $review->comment }}</p>
											</div>
										@empty
											<p class="text-muted">No reviews yet. Be the first to review this product!</p>
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
										<h5 class="pro-title"><a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a></h5>
										<p>
											@if($related->sale_price)
												<del>${{ number_format($related->price, 2) }}</del>
												<span style="color: #e74c3c;">${{ number_format($related->sale_price, 2) }}</span>
											@else
												${{ number_format($related->price, 2) }}
											@endif
										</p>
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
