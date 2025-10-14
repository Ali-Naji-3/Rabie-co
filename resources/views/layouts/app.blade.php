<!doctype html>
<html>

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Fashion Shop')</title>

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

		/* Order Completed Modal Styling */
		#checkoutModal .modal-content {
			border-radius: 12px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
			border: none;
		}
		#checkoutModal .modal-header {
			position: absolute;
			top: 0;
			right: 0;
			z-index: 1050;
			border: none;
			background: transparent;
		}
		#checkoutModal .close {
			position: relative;
			z-index: 1051;
			opacity: 0.8;
			transition: opacity 0.3s ease;
		}
		#checkoutModal .close:hover {
			opacity: 1;
		}
		#checkoutModal .modal-body {
			padding: 50px 30px;
			background-color: #ffffff;
		}
		#checkoutModal .success-icon {
			margin-bottom: 30px;
		}

		/* Center REVIEW title with ::after pseudo-element */
		.small-sec-title.text-center {
			position: relative;
			text-align: center;
		}
		.small-sec-title.text-center h6 {
			display: inline-block;
			position: relative;
			padding: 0 20px;
		}
		.small-sec-title.text-center h6::after {
			content: '';
			position: absolute;
			top: 50%;
			left: 100%;
			width: 200px;
			height: 2px;
		}
		
		/* User dropdown menu */
		.user-login:hover .cart-drop {
			opacity: 1;
			visibility: visible;
		}
		
		/* Fix will-change performance warning - Override carousel libraries */
		.owl-carousel *, 
		.slick-slider *, 
		.slider-for *, 
		.slider-nav *,
		.grid-item *,
		.sin-product *,
		.pro-tab-filter * {
			will-change: auto !important;
		}
		
		/* Only allow will-change on actively animating elements */
		.owl-item.active,
		.slick-active,
		.slider-for .slick-current,
		img:hover {
			will-change: transform !important;
			background-color: #ddd;
			transform: translateY(-50%);
		}
		.small-sec-title.text-center h6::before {
			content: '';
			position: absolute;
			top: 50%;
			right: 100%;
			width: 200px;
			height: 2px;
			background-color: #ddd;
			transform: translateY(-50%);
		}

		/* Quick View Modal Styling */
		#quickViewModal .modal-content {
			border-radius: 15px;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
			border: none;
		}
		#quickViewModal .modal-header {
			background: linear-gradient(135deg, #f53003, #ff6b35);
			color: white;
			border-radius: 15px 15px 0 0;
		}
		#quickViewModal .modal-title {
			font-weight: 600;
			font-size: 20px;
		}
		#quickViewModal .close {
			color: white;
			opacity: 0.8;
		}
		#quickViewModal .close:hover {
			opacity: 1;
		}
		#quickViewModal .product-image-container {
			position: relative;
			overflow: hidden;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
		}
		#quickViewModal .product-image-container img {
			transition: transform 0.3s ease;
		}
		#quickViewModal .product-image-container:hover img {
			transform: scale(1.05);
		}
		#quickViewModal .btn-primary {
			transition: all 0.3s ease;
		}
		#quickViewModal .btn-primary:hover {
			background-color: #d42902 !important;
			border-color: #d42902 !important;
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(245, 48, 3, 0.4);
		}
		#quickViewModal .btn-outline-secondary {
			transition: all 0.3s ease;
		}
		#quickViewModal .btn-outline-secondary:hover {
			background-color: #6c757d;
			border-color: #6c757d;
			color: white;
			transform: translateY(-2px);
		}
		#quickViewModal .product-features ul li {
			margin-bottom: 5px;
		}
		#quickViewModal .product-features ul li:before {
			content: "✓";
			color: #28a745;
			font-weight: bold;
			margin-right: 10px;
		}
	</style>

	@stack('styles')

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
								<li class="user-login" style="position: relative;">
									@auth
										<!-- Logged-in User -->
										<a href="#" style="display: flex; align-items: center; gap: 8px;">
											<div style="width: 35px; height: 35px; border-radius: 50%; background: #FFD700; color: #000; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">
												{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
											</div>
										</a>
										<!-- Dropdown Menu -->
										<div class="cart-drop" style="min-width: 200px; right: 0; left: auto;">
											<div style="padding: 15px;">
												<p style="font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
													{{ auth()->user()->name }}
												</p>
												@if(auth()->user()->role === 'admin')
													<a href="/admin" style="display: block; padding: 8px 0; color: #333;">
														<i class="fa fa-shield"></i> Admin Dashboard
													</a>
												@endif
												<a href="{{ route('cart') }}" style="display: block; padding: 8px 0; color: #333;">
													<i class="fa fa-shopping-cart"></i> My Cart
												</a>
												<form method="POST" action="{{ route('logout') }}" style="margin: 0;">
													@csrf
													<button type="submit" style="display: block; width: 100%; text-align: left; padding: 8px 0; border: none; background: none; color: #d9534f; cursor: pointer;">
														<i class="fa fa-sign-out"></i> Logout
													</button>
												</form>
											</div>
										</div>
									@else
										<!-- Guest User -->
										<a href="{{ route('login') }}" title="Login">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									@endauth
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
												<a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>View Cart</a>
											</div>
											<div class="cart-share">
												<a href="#" class="checkout-btn"><i class="fa fa-share"></i>Checkout</a>
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

					<li class="out-link"><a href="{{ route('collection') }}">COLLECTION</a></li>

					<li class="out-link"><a href="{{ route('contact') }}">CONTACT</a></li>


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

		<!-- Page Content -->
		@yield('content')

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
							<h5 class="pro-title"><a href="{{ route('collection') }}">Woman fashion dress</a></h5>
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

	<!-- Order Completed Modal -->
	<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-0">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" style="font-size: 24px; color: #999;">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<div class="success-icon mb-4">
						<i class="fa fa-check-circle" style="font-size: 80px; color: #66BB6A;"></i>
					</div>
					<h2 style="color: #333333; font-weight: bold; margin-bottom: 15px;">Order completed!</h2>
					<p style="color: #666666; font-size: 16px; margin-bottom: 0;">You will receive a confirmation email soon!</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Quick View Modal -->
	<div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-0">
					<h5 class="modal-title" id="quickViewTitle">Product Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" style="font-size: 24px; color: #999;">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="product-image-container">
								<img id="quickViewImage" src="" alt="" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
							</div>
						</div>
						<div class="col-md-6">
							<div class="product-details">
								<h4 id="quickViewProductName" style="color: #1b1b18; margin-bottom: 15px;"></h4>
								<div class="rating mb-3">
									<span style="color: #ffc107; font-size: 18px;">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</span>
									<span style="color: #666; margin-left: 10px;">(5.0)</span>
								</div>
								<div class="price mb-3">
									<h3 id="quickViewPrice" style="color: #f53003; font-weight: bold; margin: 0;"></h3>
								</div>
								<div class="product-description mb-4">
									<p style="color: #666; line-height: 1.6;">Premium quality product with excellent craftsmanship. Perfect for your collection and daily use.</p>
								</div>
								<div class="product-actions">
									<button class="btn btn-primary mr-2" style="background-color: #f53003; border-color: #f53003; padding: 10px 30px;">
										<i class="fas fa-shopping-cart mr-2"></i>Add to Cart
									</button>
									<button class="btn btn-outline-secondary" style="padding: 10px 20px;">
										<i class="fas fa-heart mr-2"></i>Add to Wishlist
									</button>
								</div>
								<div class="product-features mt-4">
									<h6 style="color: #1b1b18; margin-bottom: 10px;">Features:</h6>
									<ul style="color: #666; padding-left: 20px;">
										<li>Premium Quality Materials</li>
										<li>Fast Shipping Available</li>
										<li>30-Day Return Policy</li>
										<li>Customer Support 24/7</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Dependency Scripts -->
	<script src="{{ asset('dependencies/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('dependencies/popper.js/popper.min.js') }}"></script>
	<script src="{{ asset('dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('dependencies/owl.carousel/js/owl.carousel.min.js') }}"></script>
	
	<!-- Fix will-change memory warning from carousels -->
	<script>
		// Override carousel libraries to reduce will-change usage
		document.addEventListener('DOMContentLoaded', function() {
			// Remove will-change from all carousel elements
			const removeWillChange = () => {
				document.querySelectorAll('.owl-stage, .owl-item, .slick-track, .slick-slide, .grid-item').forEach(el => {
					el.style.willChange = 'auto';
				});
			};
			
			// Run on load and after carousels initialize
			removeWillChange();
			setTimeout(removeWillChange, 500);
			setTimeout(removeWillChange, 1000);
		});
	</script>
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc&loading=async" async defer></script>

	<!-- Site Scripts -->
	<script src="{{ asset('assets/js/app.js') }}"></script>

	<!-- Checkout Confirmation Script -->
	<script>
		$(document).ready(function() {
			// Handle checkout button click
			$('.checkout-btn').on('click', function(e) {
				e.preventDefault();
				$('#checkoutModal').modal('show');
			});
		});
	</script>

	<!-- Quick View Modal Script -->
	<script>
		$(document).ready(function() {
			// Handle quick view button clicks
			$('.quick-view-btn').on('click', function(e) {
				e.preventDefault();
				
				// Get product data from the clicked element
				var productName = $(this).data('name');
				var productImage = $(this).data('image');
				var productPrice = $(this).data('price');
				
				// Update modal content
				$('#quickViewProductName').text(productName);
				$('#quickViewImage').attr('src', productImage);
				$('#quickViewPrice').text(productPrice);
				$('#quickViewTitle').text(productName + ' - Details');
				
				// Show modal with animation
				$('#quickViewModal').modal('show');
			});

			// Handle add to cart from quick view
			$('#quickViewModal .btn-primary').on('click', function() {
				var productName = $('#quickViewProductName').text();
				
				// Show success message
				alert('Added "' + productName + '" to cart successfully!');
				
				// Close modal
				$('#quickViewModal').modal('hide');
			});

			// Handle add to wishlist
			$('#quickViewModal .btn-outline-secondary').on('click', function() {
				var productName = $('#quickViewProductName').text();
				
				// Show success message
				alert('Added "' + productName + '" to wishlist!');
				
				// Change button to show it's added
				$(this).removeClass('btn-outline-secondary').addClass('btn-success');
				$(this).html('<i class="fas fa-heart mr-2"></i>Added to Wishlist');
			});
		});
	</script>

	@stack('scripts')

</body>

</html>

