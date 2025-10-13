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

	@stack('scripts')

</body>

</html>

