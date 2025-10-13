<!doctype html>
<html>

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fashion Shop</title>

	<!-- Fav Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/fav-icons/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/fav-icons/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/fav-icons/favicon-16x16.png') }}">

	<!-- Dependency Styles -->
	<link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/fontawesome/css/fontawesome-all.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.carousel.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.theme.default.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/flaticon/css/flaticon.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/wow/css/animate.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/jquery-ui/css/jquery-ui.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/venobox/css/venobox.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/slick-carousel/css/slick.css') }}" type="text/css">

	<!-- Site Stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">

	<!-- Fix for product image clickability -->
	<style>
		.sin-product {
			position: relative;
		}
		.sin-product .pro-img {
			position: relative;
			z-index: 1;
		}
		.sin-product .pro-img a {
			display: block;
			position: relative;
			z-index: 2;
		}
		.sin-product .pro-icon {
			position: absolute;
			z-index: 10;
			pointer-events: none;
		}
		.sin-product .pro-icon a {
			pointer-events: auto;
		}
	</style>

</head>

<body id="home-version-1" class="home-version-1" data-style="default">

	<div class="site-content">

		<!--=========================-->
		<!--=        Header         =-->
		<!--=========================-->

		<header id="header" class="header-area">
			<div class="container-fluid custom-container menu-rel-container">
				<div class="row">
					<!-- Logo
					============================================= -->

					<div class="col-lg-6 col-xl-2">
						<div class="logo">
							<a href="{{ url('/') }}">
								<img src="{{ asset('media/images/logo.png') }}" alt="">
							</a>
						</div>
					</div>

					<!-- Main menu
					============================================= -->

					<div class="col-lg-12 col-xl-7 order-lg-3 order-xl-2 menu-container">
						<div class="mainmenu">
							<ul id="navigation">
								<li><a href="{{ url('/') }}" class="active">home</a></li>
								<li><a href="{{ route('collection') }}">COLLECTION</a></li>
								<li><a href="{{ route('contact') }}">CONTACT</a></li>
							</ul>
						</div>
					</div>
					<!--Main menu end-->
					<div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
						<div class="header-right-one">
							<ul>
								<li class="user-login">
									<a href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
								</li>
								<li class="top-cart">
									<a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (2)</a>
									<div class="cart-drop">
										<div class="single-cart">
											<div class="cart-img">
												<img alt="" src="{{ asset('media/images/product/car1.jpg') }}">
											</div>
											<div class="cart-title">
												<p><a href="">Aliquam Consequat</a></p>
											</div>
											<div class="cart-price">
												<p>1 x $500</p>
											</div>
											<a href="#"><i class="fa fa-times"></i></a>
										</div>
										<div class="single-cart">
											<div class="cart-img">
												<img alt="" src="{{ asset('media/images/product/car2.jpg') }}">
											</div>
											<div class="cart-title">
												<p><a href="">Quisque In Arcuc</a></p>
											</div>
											<div class="cart-price">
												<p>1 x $200</p>
											</div>
											<a href="#"><i class="fa fa-times"></i></a>
										</div>
										<div class="cart-bottom">
											<div class="cart-sub-total">
												<p>Sub-Total <span>$700</span></p>
											</div>
											<div class="cart-sub-total">
												<p>Eco Tax (-2.00)<span>$7.00</span></p>
											</div>
											<div class="cart-sub-total">
												<p>VAT (20%) <span>$40.00</span></p>
											</div>
											<div class="cart-sub-total">
												<p>Total <span>$244.00</span></p>
											</div>
											<div class="cart-checkout">
												<a href="#"><i class="fa fa-shopping-cart"></i>View Cart</a>
											</div>
											<div class="cart-share">
												<a href="#"><i class="fa fa-share"></i>Checkout</a>
											</div>
										</div>
									</div>
								</li>
								<li class="top-search">
									<a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i>
									</a>
									<input type="text" class="search-input" placeholder="Search">
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--Container-Fluid-->
		</header>
		<!--Main Header end-->

		<!--=========================-->
		<!--=        Mobile Header     =-->
		<!--=========================-->

		<header class="mobile-header">
			<div class="container-fluid custom-container">
				<div class="row">

					<!-- Mobile menu Opener
					============================================= -->
					<div class="col-4">
						<div class="accordion-wrapper">
							<a href="#" class="mobile-open"><i class="flaticon-menu-1"></i></a>
						</div>
					</div>
					<div class="col-4">
						<div class="logo">
							<a href="{{ url('/') }}">
								<img src="{{ asset('media/images/logo.png') }}" alt="">
							</a>
						</div>
					</div>
					<div class="col-4">
						<div class="top-cart">
							<a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (2)</a>
							<div class="cart-drop">
								<div class="single-cart">
									<div class="cart-img">
										<img alt="" src="{{ asset('media/images/product/car1.jpg') }}">
									</div>
									<div class="cart-title">
										<p><a href="">Aliquam Consequat</a></p>
									</div>
									<div class="cart-price">
										<p>1 x $500</p>
									</div>
									<a href="#"><i class="fa fa-times"></i></a>
								</div>
								<div class="single-cart">
									<div class="cart-img">
										<img alt="" src="{{ asset('media/images/product/car2.jpg') }}">
									</div>
									<div class="cart-title">
										<p><a href="">Quisque In Arcuc</a></p>
									</div>
									<div class="cart-price">
										<p>1 x $200</p>
									</div>
									<a href="#"><i class="fa fa-times"></i></a>
								</div>
								<div class="cart-bottom">
									<div class="cart-sub-total">
										<p>Sub-Total <span>$700</span></p>
									</div>
									<div class="cart-sub-total">
										<p>Eco Tax (-2.00)<span>$7.00</span></p>
									</div>
									<div class="cart-sub-total">
										<p>VAT (20%) <span>$40.00</span></p>
									</div>
									<div class="cart-sub-total">
										<p>Total <span>$244.00</span></p>
									</div>
									<div class="cart-checkout">
										<a href="#"><i class="fa fa-shopping-cart"></i>View Cart</a>
									</div>
									<div class="cart-share">
										<a href="#"><i class="fa fa-share"></i>Checkout</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.row end -->
			</div>
			<!-- /.container end -->
		</header>

		<div class="accordion-wrapper">

			<!-- Mobile Menu Navigation
				============================================= -->
			<div id="mobilemenu" class="accordion">
				<ul>
					<li class="mob-logo"><a href="{{ url('/') }}">
							<img src="{{ asset('media/images/logo.png') }}" alt="">
						</a></li>
					<li><a href="#" class="closeme"><i class="flaticon-close"></i></a></li>
					<li class="out-link"><a href="{{ url('/') }}">Home</a></li>

					<li class="out-link"><a href="#">COLLECTION</a></li>


				</ul>
				<div class="mobile-login">
					<a href="#">Log in</a> |
					<a href="#">Create Account</a>
				</div>
				<form action="#" id="moble-search">
					<input placeholder="Search...." type="text">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>

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
		<!--=        Feature Area      =-->
		<!--=========================-->

		<section class="feature-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<!-- Single Feature -->
					<div class="col-sm-6 col-xl-3">
						<div class="sin-feature">
							<div class="inner-sin-feature">
								<div class="icon">
									<i class="flaticon-free-delivery"></i>
								</div>
								<div class="f-content">
									<h6><a href="#">FREE SHIPPING</a></h6>
									<p>Free shipping on all order</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Single Feature -->
					<div class="col-sm-6  col-xl-3">
						<div class="sin-feature">
							<div class="inner-sin-feature">
								<div class="icon">
									<i class="flaticon-shopping-online-support"></i>
								</div>
								<div class="f-content">
									<h6><a href="#">ONLINE SUPPORT</a></h6>
									<p>Online support 24 hours</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Single Feature -->
					<div class="col-sm-6  col-xl-3">
						<div class="sin-feature">
							<div class="inner-sin-feature">
								<div class="icon">
									<i class="flaticon-return-of-investment"></i>
								</div>
								<div class="f-content">
									<h6><a href="#">MONEY RETURN</a></h6>
									<p>Back guarantee under 5 days</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Single Feature -->
					<div class="col-sm-6  col-xl-3">
						<div class="sin-feature">
							<div class="inner-sin-feature">
								<div class="icon">
									<i class="flaticon-sign"></i>
								</div>
								<div class="f-content">
									<h6><a href="#">MEMBER DISCOUNT</a></h6>
									<p>Onevery order over $150</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.feature-area -->

		<!--=========================-->
		<!--=   Product  area Two   =-->
		<!--=========================-->

		<section class="banner-product">
			<div class="container container-two">
				<div class="section-heading pb-30">
					<h3>NEW <span>TRENDING</span></h3>
				</div>
				<!-- section-heading-->
				<div class="row justify-content-center">
					<div class="col-xl-6 col-lg-4 col-md-8">
						<!-- Single Product-->
						<div class="sin-product">
							<div class="pro-img">
								<img src="{{ asset('media/images/product/b1.jpg') }}" alt="">
							</div>
							<div class="mid-wrapper style-two">
								<h5 class="pro-title"><a href="{{ route('product') }}">Colorfull long dress</a></h5>
								<div class="rating">
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star-half"></i></a></li>
									</ul>
								</div>
								<span>$60.00</span>
							</div>
							<div class="pro-icon">
								<ul>
									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>
									<li><a class="trigger" href="#"><i class="flaticon-zoom-in"></i></a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-4 col-sm-6">
						<!-- Single Product-->
						<div class="sin-product">
							<div class="pro-img">
								<img src="{{ asset('media/images/product/10.jpg') }}" alt="">
							</div>
							<div class="mid-wrapper style-two">
								<h5 class="pro-title"><a href="{{ route('product') }}">Top shirt for women</a></h5>
								<div class="rating">
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star-half"></i></a></li>
									</ul>
								</div>
								<span>$60.00</span>
							</div>
							<div class="pro-icon">
								<ul>
									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>
									<li><a class="trigger" href="#"><i class="flaticon-zoom-in"></i></a></li>
								</ul>
							</div>
						</div>
						<!-- Single Product-->
						<div class="sin-product">
							<div class="pro-img">
								<img src="{{ asset('media/images/product/11.jpg') }}" alt="">
							</div>
							<div class="mid-wrapper style-two">
								<h5 class="pro-title"><a href="{{ route('product') }}">Men long jacket</a></h5>
								<div class="rating">
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
									</ul>
								</div>
								<span>$60.00</span>
							</div>
							<div class="pro-icon">
								<ul>
									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>
									<li><a class="trigger" href="#"><i class="flaticon-zoom-in"></i></a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class=" col-lg-4 col-sm-6 col-xl-3">
						<!-- Single Product-->
						<div class="sin-product">
							<div class="pro-img">
								<img src="{{ asset('media/images/product/12.jpg') }}" alt="">
							</div>
							<div class="mid-wrapper style-two">
								<h5 class="pro-title"><a href="{{ route('product') }}">Lon  dress</a></h5>
								<div class="rating">
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fa fa-star-half"></i></a></li>
									</ul>
								</div>
								<span>$60.00</span>
							</div>
							<div class="pro-icon">
								<ul>
									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>
									<li><a class="trigger" href="#"><i class="flaticon-zoom-in"></i></a></li>
								</ul>
							</div>
						</div>
						<!-- Single Product-->
						<div class="sin-product">
							<div class="pro-img">
								<img src="{{ asset('media/images/product/13.jpg') }}" alt="">
							</div>
							<div class="mid-wrapper style-two">
								<h5 class="pro-title"><a href="{{ route('product') }}">Embellished white dress</a></h5>
								<div class="rating">
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
									</ul>
								</div>
								<span>$60.00</span>
							</div>
							<div class="pro-icon">
								<ul>
									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>
									<li><a class="trigger" href="#"><i class="flaticon-zoom-in"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- Container-two  -->
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
					<div class="col-sm-6 col-md-6 col-xl-3">
						<div class="small-sec-title">
							<h6>TOP <span>SALE</span></h6>
						</div>
						<!-- Single product-->
						<div class="sin-product-s">
							<div class="sp-img">
								<img src="{{ asset('media/images/product/s9.jpg') }}" alt="">
							</div>
							<div class="small-pro-details">
								<h5 class="title"><a href="#">Sunglass dark color</a></h5>
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
								<a href="#">Buy Now</a>
							</div>
						</div>

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
								<a href="#">Buy Now</a>
							</div>
						</div>


					</div>
					<!-- col -->

					<div class="col-sm-6 col-xl-3  col-md-6">
						<div class="small-sec-title">
							<h6>TOP <span>RATED</span></h6>
						</div>
						<!-- Single product-->
						<div class="sin-product-s">
							<div class="sp-img">
								<img src="{{ asset('media/images/product/s1.jpg') }}" alt="">
							</div>
							<div class="small-pro-details">
								<h5 class="title"><a href="#">Blue girls cap</a></h5>
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
								<a href="#">Buy Now</a>

							</div>
						</div>

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
								<a href="#">Buy Now</a>
							</div>
						</div>


					</div>
					<!-- col -->

					<div class="col-sm-6 col-xl-3  col-md-6">
						<div class="small-sec-title">
							<h6>WEEKLY <span>BEST</span></h6>
						</div>
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
								<a href="#">Buy Now</a>
							</div>
						</div>

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
								<a href="#">Buy Now</a>
							</div>
						</div>


					</div>
					<!-- col -->

					<div class="col-sm-6 col-xl-3 col-md-6">
						<div class="small-sec-title">
							<h6>SALE <span>OFF</span></h6>
						</div>
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
								<a href="#">Buy Now</a>
							</div>
						</div>

						<!-- Single product-->
						<div class="sin-product-s">
							<div class="sp-img">
								<img src="{{ asset('media/images/product/s7.jpg') }}" alt="">
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
								<a href="#">Buy Now</a>
							</div>
						</div>
					</div>
					<!-- col -->
				</div>
				<!-- row -->
			</div>
			<!-- container-fluid End-->
		</section>


		<!--=========================-->
		<!--=   Instagram area      =-->
		<!--=========================-->

		<section class="instagram-area">
			<div class="instagram-slider owl-carousel owl-theme">
				<!-- single instagram-slider -->
				<div class="sin-instagram">
					<img src="{{ asset('media/images/instagram/1.jpg') }}" alt="">
					<div class="hover-text">
						<a href="#">
					<img src="{{ asset('media/images/icon/ig.png') }}" alt="">
					<span>instagram</span>
				</a>
					</div>
				</div>
				<!-- single instagram-slider -->
				<div class="sin-instagram">
					<img src="{{ asset('media/images/instagram/2.jpg') }}" alt="">
					<div class="hover-text">
						<a href="#">
					<img src="{{ asset('media/images/icon/ig.png') }}" alt="">
					<span>instagram</span>
				</a>
					</div>
				</div>
				<!-- single instagram-slider -->
				<div class="sin-instagram">
					<img src="{{ asset('media/images/instagram/3.jpg') }}" alt="">
					<div class="hover-text">
						<a href="#">
					<img src="{{ asset('media/images/icon/ig.png') }}" alt="">
					<span>instagram</span>
				</a>
					</div>
				</div>
				<!-- single instagram-slider -->
				<div class="sin-instagram">
					<img src="{{ asset('media/images/instagram/4.jpg') }}" alt="">
					<div class="hover-text">
						<a href="#">
					<img src="{{ asset('media/images/icon/ig.png') }}" alt="">
					<span>instagram</span>
				</a>
					</div>
				</div>
				<!-- single instagram-slider -->
				<div class="sin-instagram">
					<img src="{{ asset('media/images/instagram/5.jpg') }}" alt="">
					<div class="hover-text">
						<a href="#">
					<img src="{{ asset('media/images/icon/ig.png') }}" alt="">
					<span>instagram</span>
				</a>
					</div>
				</div>
			</div>
			<!-- /.instagram-slider end -->
		</section>
		<!-- /.instagram-area end-->

		<!--=========================-->
		<!--=   Footer area      =-->
		<!--=========================-->

		<footer class="footer-widget-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<div class="logo">
								<a href="#">
							<img src="{{ asset('media/images/logo2.png') }}" alt="">
						</a>
							</div>
							<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illum dolore eu olestie consequat Autem vel eum iriure dolor.</p>
							<div class="social">
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#"><i class="fab fa-dribbble"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>our shop</h3>
							<div class="footer-menu">
								<ul>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Browse Products</a></li>
									<li><a href="#">Read Our Blog</a></li>
									<li><a href="#">Contact Us</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>COLLECTIONS</h3>
							<div class="footer-menu">
								<ul>
									<li><a href="#">Summer 2024</a></li>
									<li><a href="#">Women's Dresses</a></li>
									<li><a href="#">Women's Jackets</a></li>
									<li><a href="#">Men's Shirts</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>Payment Methods</h3>
							<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illum</p>
							<div class="payment-link">
								<ul>
									<li><a href="#"><img src="{{ asset('media/images/p1.png') }}" alt=""></a></li>
									<li><a href="#"><img src="{{ asset('media/images/p2.png') }}" alt=""></a></li>
									<li><a href="#"><img src="{{ asset('media/images/p3.png') }}" alt=""></a></li>
									<li><a href="#"><img src="{{ asset('media/images/p4.png') }}" alt=""></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
				</div>
				<div class="footer-bottom">
					<div class="row">
						<div class="col-12">
							<p>Copyright © <span>2024</span> ThemeIM Solution • Designed by <a href="#">ThemeIM</a></p>
						</div>
						<!-- /.col-xl-6 -->

					</div>
					<!-- /.row -->
				</div>
			</div>
			<!-- container-fluid -->
		</footer>
		<!-- footer-widget-area -->



		<!-- Back to top
	============================================= -->

		<div class="backtotop">
			<i class="fa fa-angle-up backtotop_btn"></i>
		</div>


		<!--=========================-->
		<!--=   Product Quick view area    =-->
		<!--=========================-->

		<!-- Quick View -->
		<div class="modal quickview-wrapper">
			<div class="quickview">
				<div class="row">
					<div class="col-12">
						<span class="close-qv">
					<i class="flaticon-close"></i>
				</span>
					</div>
					<div class="col-md-6">
						<!-- Product View Slider -->
						<div class="quickview-slider">
							<div class="slider-for">
								<div class="">
									<img src="{{ asset('media/images/product/single/b1.jpg') }}" alt="Thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b2.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b3.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b4.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b5.jpg') }}" alt="Thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b1.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b2.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b3.jpg') }}" alt="thumb">
								</div>
							</div>

							<div class="slider-nav">

								<div class="">
									<img src="{{ asset('media/images/product/single/b1.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b2.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b3.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<div class="">
										<img src="{{ asset('media/images/product/single/b4.jpg') }}" alt="Thumb">
									</div>
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b5.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b1.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b2.jpg') }}" alt="thumb">
								</div>
								<div class="">
									<img src="{{ asset('media/images/product/single/b3.jpg') }}" alt="thumb">
								</div>
							</div>
						</div>
						<!-- /.quickview-slider -->
					</div>
					<!-- /.col-xl-6 -->

					<div class="col-md-6">
						<div class="product-details">
							<h5 class="pro-title"><a href="{{ route('product') }}">Woman fashion dress</a></h5>
							<span class="price">Price : $387</span>
							<div class="size-variation">
								<span>size :</span>
								<select name="size-value">
							<option value="">1</option>
							<option value="">2</option>
							<option value="">3</option>
							<option value="">4</option>
							<option value="">5</option>
						</select>
							</div>
							<div class="color-variation">
								<span>color :</span>
								<ul>
									<li><i class="fas fa-circle"></i></li>
									<li><i class="fas fa-circle"></i></li>
									<li><i class="fas fa-circle"></i></li>
									<li><i class="fas fa-circle"></i></li>
								</ul>
							</div>

							<div class="add-tocart-wrap">
								<!--PRODUCT INCREASE BUTTON START-->
								<div class="cart-plus-minus-button">
									<input type="text" value="1" name="qtybutton" class="cart-plus-minus">
								</div>
								<a href="#" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
								<!-- <a href="#"><i class="flaticon-valentines-heart"></i></a> -->
							</div>

							<!-- <span>SKU:	N/A</span>
								<p>Tags <a href="#">boys,</a><a href="#"> dress,</a><a href="#">Rok-dress</a></p> -->

							<p>But I must explain to you how all this mistaken idedenounc pleasure and praisi pain was born and I will give you a complete accosystem, and expound the actu teachings of the great explore tmaster-builder of human happiness. No one rejects, dislikes,
								or avoids.</p>

							<div class="product-social">
								<span>Share :</span>
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								</ul>
							</div>

						</div>
						<!-- /.product-details -->
					</div>
					<!-- /.col-xl-6 -->
				</div>
				<!-- /.row -->
			</div>
		</div>





	</div>
	<!-- /#site -->

	<!-- Dependency Scripts -->
	<script src="{{ asset('dependencies/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('dependencies/popper.js/popper.min.js') }}"></script>
	<script src="{{ asset('dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('dependencies/owl.carousel/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('dependencies/wow/js/wow.min.js') }}"></script>
	<script src="{{ asset('dependencies/isotope-layout/js/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('dependencies/imagesloaded/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('dependencies/jquery.countdown/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('dependencies/gmap3/js/gmap3.min.js') }}"></script>
	<script src="{{ asset('dependencies/venobox/js/venobox.min.js') }}"></script>
	<script src="{{ asset('dependencies/slick-carousel/js/slick.js') }}"></script>
	<script src="{{ asset('dependencies/headroom/js/headroom.js') }}"></script>
	<script src="{{ asset('dependencies/jquery-ui/js/jquery-ui.min.js') }}"></script>
	<!--Google map api -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc"></script>


	<!-- Site Scripts -->
	<script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
