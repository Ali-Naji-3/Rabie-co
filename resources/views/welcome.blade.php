@extends('layouts.app')

@section('title', 'Fashion Shop - Home')

@section('content')

	<!--=========================-->
	<!--=        Slider         =-->
	<!--=========================-->

	<section class="slider-wrapper">
		<div class="slider-start slider-1 owl-carousel owl-theme">

			<div class="item">
				<img src="{{ asset('media/images/banner/f1.jpg') }}" alt="">
				<div class="container-fluid custom-container slider-content">
					<div class="row align-items-center">

						<div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
							<div class="slider-text ">
								<h4 class="animated fadeInUp"><span>BRAND NEW</span> COLLECTION</h4>
								<h1 class="animated fadeInUp">COMERCIO SHOP</h1>
								<p class="animated fadeInUp">Autem vel eum iriure dolor in molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
								<a class="animated fadeInUp btn-two" href="#">SHOP NOW</a>
							</div>
						</div>
						<!-- Col End -->
					</div>
					<!-- Row End -->
				</div>
			</div>

			<div class="item">
				<img src="{{ asset('media/images/banner/f2.jpg') }}" alt="">
				<div class="container-fluid custom-container slider-content">
					<div class="row align-items-center">

						<div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
							<div class="slider-text ">
								<h4 class="animated fadeIn"><span>BRAND NEW</span> COLLECTION</h4>
								<h1 class="animated fadeIn">NEW ARRIVALS</h1>
								<p class="animated fadeIn">Autem vel eum iriure dolor in hendrerit molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
								<a class="animated fadeIn btn-two" href="#">SHOP NOW</a>
							</div>
						</div>
						<!-- Col End -->
					</div>
					<!-- Row End -->
				</div>
			</div>

			<div class="item">
				<img src="{{ asset('media/images/banner/f3.jpg') }}" alt="">
				<div class="container-fluid custom-container slider-content">
					<div class="row align-items-center">
						<div class="col-12 col-sm-8 col-md-8 offset-md-1 col-lg-6 offset-xl-2 col-xl-5 mr-auto">
							<div class="slider-text mob-align-left">
								<h4 class="animated fadeIn"><span>LATEST COLLECTION </span> 2024 </h4>
								<h1 class="animated fadeIn">STYLE & GRACE </h1>
								<p class="animated fadeIn">Autem vel eum iriure dolor molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
								<a class="animated fadeIn btn-two" href="#">SHOP NOW</a>
							</div>
						</div>
						<!-- Col End -->
					</div>
					<!-- Row End -->
				</div>
			</div>

		</div>
	</section>
	<!-- Slides end -->

	<!--=========================-->
	<!--=        Product Filter      =-->
	<!--=========================-->

	<section class="main-product">
		<div class="container container-two">
			<div class="section-heading">
				<h3>Welcome to <span>product</span></h3>
			</div>
			<!-- /.section-heading-->
			<div class="row">
				<div class="col-xl-12 ">
					<div class="pro-tab-filter">
						<ul class="pro-tab-button">
							<li class="filter active" data-filter="*">ALL</li>
						</ul>
						<div class="grid row">
							@forelse($featuredProducts as $product)
								<!-- single product -->
								<div class="grid-item col-6 col-md-6 col-lg-4 col-xl-3">
									<div class="sin-product style-one">
										<div class="pro-img" style="height: 250px; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center;">
											<a href="{{ route('product.show', $product->slug) }}">
												<img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/1.jpg') }}" 
													alt="{{ $product->name }}"
													loading="lazy"
													style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
											</a>
											@if($product->stock === 0)
												<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10;">OUT OF STOCK</span>
											@elseif($product->discount_percentage > 0)
												<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10; font-size: 14px; font-weight: bold; color: white;">{{ $product->discount_percentage }}% OFF</span>
											@endif
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title" style="font-size: 20px; font-weight: 900; color: #222; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
												<a href="{{ route('product.show', $product->slug) }}" style="color: #222; text-decoration: none; font-weight: 900;">{{ $product->name }}</a>
											</h5>
										<div class="price-section">
											@if($product->discount_percentage > 0)
												<div class="mb-1">
													<span style="color: #e74c3c; font-size: 18px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 3px;">
														${{ number_format($product->price, 2) }}
													</span>
												</div>
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 24px; font-weight: bold; letter-spacing: 1px;">
														${{ number_format($product->sale_price, 2) }}
													</span>
												</div>
											@else
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 24px; font-weight: bold; letter-spacing: 1px;">
														${{ number_format($product->price, 2) }}
													</span>
												</div>
											@endif
										</div>
										</div>
									</div>
								</div>
							@empty
								<div class="col-12 text-center">
									<p>No featured products available at the moment.</p>
								</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
			<!-- Row End -->
		</div>
		<!-- Container  -->
	</section>
	<!-- main-product -->

	<!--=========================-->
	<!--=   Discount Countdown area   =-->
	<!--=========================-->

	<section class="add-area">
		<a href="#"><img src="{{ asset('media/images/banner/add.jpg') }}" alt=""></a>
	</section>

	<!--=========================-->
	<!--=   Small Product area    =-->
	<!--=========================-->

	<section class="product-small">
		<div class="container-fluid  custom-container">
			<div class="row">
				<div class="col-12">
					<div class="small-sec-title text-center">
						<h6><span style="color: #FFD700;">⭐ FEATURED CUSTOMER REVIEWS</span></h6>
						<p style="color: #666; font-size: 14px; margin-top: 10px;">See what our customers are saying about their favorite products</p>
					</div>
				</div>
			</div>
			
			<div class="row">
				@forelse($featuredReviews as $review)
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<!-- Featured Review Card -->
					<div class="featured-review-card" style="background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); height: 100%; position: relative; transition: all 0.3s ease;">
						<!-- Pin Badge -->
						<div class="pin-badge" style="position: absolute; top: 15px; right: 15px; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #000; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);">
							📌 FEATURED
						</div>
						
						<!-- Product Info -->
						<div class="review-product-info" style="margin-bottom: 20px;">
							<a href="{{ route('product.show', $review->product->slug) }}" style="text-decoration: none;">
								<div class="product-image" style="width: 100%; height: 180px; border-radius: 8px; overflow: hidden; margin-bottom: 15px;">
									<img src="{{ $review->product->primary_image ? asset('storage/' . $review->product->primary_image) : asset('media/images/product/default.jpg') }}" 
									     alt="{{ $review->product->name }}"
									     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
									     onmouseover="this.style.transform='scale(1.05)'"
									     onmouseout="this.style.transform='scale(1)'">
								</div>
								<h6 style="color: #222; font-size: 16px; font-weight: 700; margin-bottom: 10px; text-transform: uppercase;">{{ $review->product->name }}</h6>
							</a>
						</div>
						
						<!-- Rating -->
						<div class="review-rating" style="margin-bottom: 15px;">
							@for($i = 1; $i <= 5; $i++)
								<i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#FFD700' : '#ddd' }}; font-size: 18px;"></i>
							@endfor
							<span style="color: #666; font-size: 14px; margin-left: 8px; font-weight: 600;">{{ $review->rating }}/5</span>
						</div>
						
						<!-- Review Title -->
						@if($review->title)
						<h5 style="color: #333; font-size: 15px; font-weight: 700; margin-bottom: 12px; line-height: 1.4;">
							"{{ Str::limit($review->title, 50) }}"
						</h5>
						@endif
						
						<!-- Review Comment -->
						<p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
							{{ Str::limit($review->comment, 120) }}
						</p>
						
						<!-- Reviewer Info -->
						<div class="reviewer-info" style="display: flex; align-items: center; padding-top: 15px; border-top: 2px solid #f0f0f0;">
							<div class="reviewer-avatar" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 16px; margin-right: 12px;">
								{{ strtoupper(substr($review->user->name, 0, 1)) }}
							</div>
							<div>
								<p style="margin: 0; color: #333; font-weight: 600; font-size: 14px;">{{ $review->user->name }}</p>
								<p style="margin: 0; color: #999; font-size: 12px;">{{ $review->created_at->format('M d, Y') }}</p>
							</div>
						</div>
						
						<!-- View Product Button -->
						<a href="{{ route('product.show', $review->product->slug) }}" 
						   style="display: block; text-align: center; margin-top: 20px; background: #000; color: #FFD700; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;"
						   onmouseover="this.style.background='#FFD700'; this.style.color='#000'"
						   onmouseout="this.style.background='#000'; this.style.color='#FFD700'">
							VIEW PRODUCT
						</a>
					</div>
				</div>
				
				@empty
				<div class="col-12">
					<div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 12px;">
						<i class="fas fa-star" style="font-size: 60px; color: #ddd; margin-bottom: 20px;"></i>
						<h4 style="color: #666; margin-bottom: 15px;">No Featured Reviews Yet</h4>
						<p style="color: #999; font-size: 16px;">Pin reviews from the admin dashboard to showcase them here!</p>
						@auth
							@if(auth()->user()->role === 'admin')
								<a href="{{ url('/admin/reviews') }}" style="display: inline-block; margin-top: 20px; background: #000; color: #FFD700; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 700;">
									GO TO ADMIN DASHBOARD
								</a>
							@endif
						@endauth
					</div>
				</div>
				@endforelse
			</div>
			<!-- row -->
		</div>
		<!-- container-fluid End-->
	</section>

@endsection
