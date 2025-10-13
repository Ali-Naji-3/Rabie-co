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
							<!-- single product -->
							<div class=" grid-item two col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/1.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Embellished print dress</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
							<!-- single product -->
							<div class=" grid-item three col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/2.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Shirt for men</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
							<!-- single product -->
							<div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/3.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Embellished print t-shirt  </a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
							<!-- single product -->
							<div class=" grid-item five col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/4.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Laptop carry bag</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
							<!-- single product -->
							<div class=" grid-item one col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/5.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Sleeve detail dress</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
							<!-- single product -->
							<div class=" grid-item two col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/6.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Jeans cloth dress</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>

							<!-- single product -->
							<div class=" grid-item three col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/7.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Winter dress</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>

							<!-- single product -->
							<div class=" grid-item four col-6 col-md-6  col-lg-4 col-xl-3">
								<div class="sin-product style-one">
									<div class="pro-img">
										<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/8.jpg') }}" alt=""></a>
									</div>
									<div class="mid-wrapper">
										<h5 class="pro-title"><a href="{{ route('product') }}">Mens Jacket</a></h5>
										<span>$60.00</span>
									</div>

								</div>
							</div>
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
						<h6><span style="color: #FFD700;">REVIEW</span></h6>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s9.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#" class="quick-view-btn" data-name="Sunglass dark color" data-image="{{ asset('media/images/product/s9.jpg') }}" data-price="$60">Sunglass dark color</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
								</ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Sunglass dark color" data-image="{{ asset('media/images/product/s9.jpg') }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s1.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#" class="quick-view-btn" data-name="Blue girls cap" data-image="{{ asset('media/images/product/s1.jpg') }}" data-price="$60">Blue girls cap</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
								</ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s9.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#">Contrasting T-Shirt</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
                    </ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s6.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#">Contrasting T-Shirt</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
                    </ul>
                </div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s2.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#">Top dress</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
								</ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s11.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#">Red tops</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
								</ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
                </div>
        </div>

				<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
					<!-- Single product-->
					<div class="sin-product-s">
						<div class="sp-img">
							<img src="{{ asset('media/images/product/s4.jpg') }}" alt="">
						</div>
						<div class="small-pro-details">
							<h5 class="title"><a href="#">Sunglas</a></h5>
							<div class="rating">
								<ul>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
									<li><a href="#"><i class="fas fa-star"></i></a></li>
								</ul>
							</div>
							<span>$60</span>
							<a href="#" class="quick-view-btn" data-name="Product Name" data-image="{{ asset("media/images/product/s1.jpg") }}" data-price="$60">QUICK VIEW</a>
						</div>
					</div>
				</div>
			</div>
			<!-- row -->
		</div>
		<!-- container-fluid End-->
	</section>

@endsection
