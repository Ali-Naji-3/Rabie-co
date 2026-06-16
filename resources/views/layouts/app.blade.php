<!doctype html>
<html>

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https://maps.googleapis.com https://maps.gstatic.com https://fonts.googleapis.com https://fonts.gstatic.com https://fonts.bunny.net https://unpkg.com; img-src 'self' data: blob: https:; connect-src 'self' https://maps.googleapis.com https://maps.gstatic.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com https://fonts.bunny.net; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://unpkg.com; font-src 'self' data: https://fonts.gstatic.com https://fonts.bunny.net;">
	
	<!-- SEO Meta Tags -->
	<title>@yield('title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Rabie-Co Fashion Store')</title>
	<meta name="description" content="@yield('description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Rabie-Co. Premium clothing, accessories, and exclusive collections.')">
	<meta name="keywords" content="@yield('keywords', $siteSettings->meta_keywords ?? 'fashion, clothing, accessories, online store, premium brands, style')">
	<meta name="author" content="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
	<meta name="robots" content="index, follow">
	
	<!-- Open Graph Meta Tags (Social Media) -->
	<meta property="og:title" content="@yield('og_title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Rabie-Co Fashion Store')">
	<meta property="og:description" content="@yield('og_description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Rabie-Co. Premium clothing, accessories, and exclusive collections.')">
	<meta property="og:image" content="@yield('og_image', $siteSettings->og_image ? asset('storage/' . $siteSettings->og_image) : asset('media/images/logo.png'))">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
	
	<!-- Twitter Card Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('og_title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Rabie-Co Fashion Store')">
	<meta name="twitter:description" content="@yield('og_description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Rabie-Co.')">
	<meta name="twitter:image" content="@yield('og_image', $siteSettings->og_image ? asset('storage/' . $siteSettings->og_image) : asset('media/images/logo.png'))">
	
	<!-- Additional SEO Meta Tags -->
	<meta name="theme-color" content="#f53003">
	<meta name="msapplication-TileColor" content="#f53003">
	<link rel="canonical" href="{{ url()->current() }}">

	<!-- Fav Icon (Dynamic from Site Settings) -->
	@if($siteSettings->favicon)
		<link rel="icon" type="image/png" href="{{ asset('storage/' . $siteSettings->favicon) }}">
		<link rel="apple-touch-icon" href="{{ asset('storage/' . $siteSettings->favicon) }}">
	@else
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/fav-icons/apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/fav-icons/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/fav-icons/favicon-16x16.png') }}">
	@endif

	<!-- Dependency Styles -->
	<link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/fontawesome/css/fontawesome-all.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.carousel.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.theme.default.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/flaticon/css/flaticon.css') }}" type="text/css">

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

		/* Checkout Modal CSS Removed - No longer needed */

		
		/* User dropdown menu */
		.user-login:hover .cart-drop {
			opacity: 1;
			visibility: visible;
		}
		
		/* Fix will-change performance warning - Remove from all elements */
		* {
			will-change: auto !important;
		}
		
		/* Only use will-change on actively interacting elements */
		.social-icons-grid a:active,
		.btn:active,
		button:active {
			will-change: transform !important;
		}
		
		
		/* Footer Social Media Hover Effects */
		.social-media-section a:hover {
			transform: translateY(-3px);
			box-shadow: 0 6px 16px rgba(0,0,0,0.3) !important;
		}
		
		/* Professional Social Media Grid */
		.social-icons-grid {
			display: grid !important;
			grid-template-columns: repeat(3, 1fr) !important;
			gap: 12px !important;
			max-width: 180px !important;
		}
		
		.social-icons-grid a {
			width: 50px !important;
			height: 50px !important;
			border-radius: 50% !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			text-decoration: none !important;
			transition: all 0.3s ease !important;
			box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
			position: relative !important;
			overflow: hidden !important;
		}
		
		/* Individual Social Media Colors */
		.social-facebook { background: #1877F2 !important; color: white !important; }
		.social-instagram { background: linear-gradient(45deg, #F58529, #DD2A7B, #8134AF, #515BD4) !important; color: white !important; }
		.social-twitter { background: #1DA1F2 !important; color: white !important; }
		.social-linkedin { background: #0A66C2 !important; color: white !important; }
		.social-youtube { background: #FF0000 !important; color: white !important; }
		.social-tiktok { background: #000000 !important; color: white !important; }
		
		.social-icons-grid a i {
			font-size: 20px !important;
		}
		
		.social-icons-grid a::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
			transition: left 0.5s;
		}
		
		.social-icons-grid a:hover::before {
			left: 100%;
		}
		
		.social-icons-grid a:hover {
			transform: translateY(-3px) scale(1.05) !important;
			box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
		}
		
		/* Responsive adjustments */
		@media (max-width: 768px) {
			.social-icons-grid {
				grid-template-columns: repeat(2, 1fr) !important;
				max-width: 120px !important;
				gap: 10px !important;
			}
			
			.social-icons-grid a {
				width: 45px !important;
				height: 45px !important;
			}
			
			.social-icons-grid a i {
				font-size: 18px !important;
			}
		}
		.sin-product .icon-wrapper {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s ease;
		}
		.sin-product:hover .icon-wrapper {
			opacity: 1;
			visibility: visible;
		}
		
		/* Enhanced icon visibility */
		.flaticon-eye,
		.flaticon-valentines-heart {
			font-size: 18px !important;
			color: #333 !important;
			background: rgba(255, 255, 255, 0.95) !important;
			border-radius: 50% !important;
			width: 40px !important;
			height: 40px !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
			transition: all 0.3s ease !important;
			border: 2px solid #fff !important;
		}
		.flaticon-eye:hover,
		.flaticon-valentines-heart:hover {
			background: #27ae60 !important;
			color: #fff !important;
			transform: scale(1.1) !important;
			box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3) !important;
		}
		.pro-icon ul {
			display: flex !important;
			gap: 10px !important;
			justify-content: center !important;
			padding: 10px 0 !important;
		}
		.pro-icon li {
			list-style: none !important;
		}
		.pro-icon a {
			text-decoration: none !important;
		}
		
		/* Fix scroll-linked positioning warning */
		#header {
			position: relative !important;
		}
		* {
			scroll-behavior: auto !important;
		}
		
		/* Fast page transitions */
		body {
			transition: opacity 0.15s ease;
		}
		
		/* Fast navigation link hover effects */
		#navigation a, #mobilemenu a {
			transition: all 0.15s ease;
		}
		
		#navigation a:hover, #mobilemenu a:hover {
			transform: translateY(-1px);
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

		/* Cart remove button fix: position the form where .fa-times was, reset icon to static */
		.cart-drop .single-cart form.cart-remove-form {
			position: absolute;
			right: 2px;
			top: 38px;
			width: 20px;
			height: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0;
			padding: 0;
		}
		.cart-drop .single-cart form.cart-remove-form .fa-times {
			position: static;
			width: auto;
			height: auto;
			line-height: normal;
		}

		/* ============================================================
		   ANIMATE.CSS MICRO-REPLACEMENT
		   Only the 5 classes actually used in views + DB.
		   Replaces the full 56 KB animate.css library.
		   Class names are unchanged so DB values, Filament dropdown,
		   and all jQuery addClass/removeClass calls need no edits.
		   ============================================================ */
		.animated { animation-duration: 1s; animation-fill-mode: both; }
		@keyframes fadeInUp {
			from { opacity: 0; transform: translate3d(0, 30px, 0); }
			to   { opacity: 1; transform: translate3d(0, 0, 0); }
		}
		.fadeInUp { animation-name: fadeInUp; }
		@keyframes fadeIn {
			from { opacity: 0; }
			to   { opacity: 1; }
		}
		.fadeIn { animation-name: fadeIn; }
		@keyframes fadeInDown {
			from { opacity: 0; transform: translate3d(0, -30px, 0); }
			to   { opacity: 1; transform: translate3d(0, 0, 0); }
		}
		.fadeInDown { animation-name: fadeInDown; }
		@keyframes slideInLeft {
			from { opacity: 0; transform: translate3d(-60px, 0, 0); }
			to   { opacity: 1; transform: translate3d(0, 0, 0); }
		}
		.slideInLeft { animation-name: slideInLeft; }
		@keyframes slideInRight {
			from { opacity: 0; transform: translate3d(60px, 0, 0); }
			to   { opacity: 1; transform: translate3d(0, 0, 0); }
		}
		.slideInRight { animation-name: slideInRight; }

		/* ============================================================
		   PREMIUM MOTION SYSTEM (compositor-friendly: transform/opacity)
		   Aurora hero · Scroll reveal · Image zoom · CTA glow
		   ============================================================ */

		/* 1. AURORA HERO — CSS-only animated gradient behind the slider.
		   Uses blurred radial blobs moved via transform (no repaint of
		   layout/paint-heavy props). Confined to the hero only. */
		.slider-wrapper {
			position: relative;
			isolation: isolate;
			overflow: hidden;
		}
		.slider-wrapper .aurora {
			position: absolute;
			inset: -20%;
			z-index: -1;
			pointer-events: none;
			overflow: hidden;
		}
		.slider-wrapper .aurora::before,
		.slider-wrapper .aurora::after {
			content: "";
			position: absolute;
			width: 60vw;
			height: 60vw;
			border-radius: 50%;
			filter: blur(80px);
			opacity: 0.55;
			/* !important needed to survive the global `* { will-change:auto !important }`
			   rule above — the aurora animates continuously, so it benefits from a
			   persistent compositor layer. */
			will-change: transform !important;
			transform: translate3d(0, 0, 0);
		}
		/* Palette stops pulled from existing brand colors — no color change */
		.slider-wrapper .aurora::before {
			top: -10%;
			left: -5%;
			background: radial-gradient(circle at center, #f49935 0%, rgba(244,153,53,0) 70%);
			animation: auroraDriftA 22s ease-in-out infinite alternate;
		}
		.slider-wrapper .aurora::after {
			bottom: -15%;
			right: -10%;
			background: radial-gradient(circle at center, #fad959 0%, rgba(250,217,89,0) 70%);
			animation: auroraDriftB 26s ease-in-out infinite alternate;
		}
		@keyframes auroraDriftA {
			0%   { transform: translate3d(0, 0, 0) scale(1); }
			100% { transform: translate3d(12%, 8%, 0) scale(1.15); }
		}
		@keyframes auroraDriftB {
			0%   { transform: translate3d(0, 0, 0) scale(1.1); }
			100% { transform: translate3d(-10%, -6%, 0) scale(1); }
		}

		/* 2. SCROLL REVEAL — toggled by IntersectionObserver. Subtle rise + fade. */
		.reveal {
			opacity: 0;
			transform: translate3d(0, 24px, 0);
			transition: opacity 0.7s ease, transform 0.7s ease;
			/* transform/opacity auto-promote to a compositor layer during the
			   transition — no persistent will-change needed (and the global rule
			   above would strip it anyway). */
		}
		.reveal.reveal--in {
			opacity: 1;
			transform: translate3d(0, 0, 0);
		}

		/* 3. IMAGE ZOOM — subtle, framed, no layout shift. */
		.sin-product .pro-img {
			overflow: hidden;
		}
		.sin-product .pro-img img {
			transition: transform 0.5s ease;
			backface-visibility: hidden;
		}
		.sin-product:hover .pro-img img {
			transform: scale(1.06);
		}

		/* 4. MOUSE-REACTIVE GLOW + MAGNETIC PULL — hero CTA only.
		   Glow follows cursor via CSS custom props; magnetic translate set in JS.
		   The transition smooths the pull and the spring-back on mouseleave.
		   transform-only → compositor-friendly, no layout thrash. */
		.cta-primary {
			position: relative;
			overflow: hidden;
			isolation: isolate;
			transition: transform 0.25s cubic-bezier(0.23, 1, 0.32, 1);
		}
		.cta-primary::before {
			content: "";
			position: absolute;
			inset: 0;
			z-index: -1;
			background: radial-gradient(
				120px circle at var(--glow-x, 50%) var(--glow-y, 50%),
				rgba(255, 255, 255, 0.45),
				rgba(255, 255, 255, 0) 60%
			);
			opacity: 0;
			transition: opacity 0.3s ease;
		}
		.cta-primary:hover::before {
			opacity: 1;
		}

		/* ACCESSIBILITY / PERF — honor reduced motion: kill all motion,
		   reveal content immediately, no aurora drift, no zoom, no glow. */
		@media (prefers-reduced-motion: reduce) {
			.animated { animation: none !important; }
			.slider-wrapper .aurora::before,
			.slider-wrapper .aurora::after {
				animation: none;
			}
			.reveal {
				opacity: 1;
				transform: none;
				transition: none;
			}
			.sin-product:hover .pro-img img {
				transform: none;
			}
			.cta-primary::before {
				display: none;
			}
			.cta-primary {
				transform: none !important;
				transition: none;
			}
		}
	</style>

	@stack('styles')

	<!-- Active Navigation Highlighting -->
	<style>
		/* Desktop Navigation Active State */
		#navigation li a.active {
			color: #FFD700 !important;
			font-weight: 700 !important;
			position: relative;
		}
		
		#navigation li a.active::after {
			content: '';
			position: absolute;
			bottom: -5px;
			left: 0;
			width: 100%;
			height: 3px;
			background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
			border-radius: 2px;
			box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);
		}
		
		/* Mobile Navigation Active State */
		#mobilemenu .out-link.active a {
			color: #FFD700 !important;
			font-weight: 700 !important;
			background: rgba(255, 215, 0, 0.1);
			padding-left: 20px !important;
			border-left: 4px solid #FFD700;
		}
		
		/* Hover effect for non-active items */
		#navigation li a:not(.active):hover {
			color: #FFA500 !important;
		}
	</style>

	@vite(['resources/css/app.css', 'resources/js/app.js'])

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
							@if($siteSettings->logo)
								<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@else
								<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@endif
						</a>
					</div>
				</div>

					<!-- Main menu
					============================================= -->

					<div class="col-lg-12 col-xl-7 order-lg-3 order-xl-2 menu-container">
						<div class="mainmenu">
							<ul id="navigation">
								<li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">home</a></li>
								<li><a href="{{ route('collection') }}" class="{{ request()->is('collection*') || request()->is('product/*') ? 'active' : '' }}">COLLECTION</a></li>
								<li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">CONTACT</a></li>
							</ul>
						</div>
					</div>
					<!--Main menu end-->
					<div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
						<div class="header-right-one">
							<ul>
								@auth
									@php
										$userHasOrders = \App\Models\Order::where('user_id', auth()->id())->exists();
									@endphp
									@if($userHasOrders)
										<li>
											<a href="{{ route('orders.index') }}" title="My Orders" style="display: flex; align-items: center; gap: 5px;">
												<i class="fa fa-list-alt" aria-hidden="true"></i>
												<span style="font-size: 13px; font-weight: 500;">My Orders</span>
											</a>
										</li>
									@endif
								@endauth
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
												@if($userHasOrders)
													<a href="{{ route('orders.index') }}" style="display: block; padding: 8px 0; color: #333;">
														<i class="fa fa-list-alt"></i> My Orders
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
								<a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ({{ $globalCartCount }})</a>
								<div class="cart-drop">
									@forelse($globalCartItems as $item)
										<div class="single-cart">
											<div class="cart-img">
												<img alt="{{ $item->product->name }}" src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/car1.jpg') }}">
											</div>
											<div class="cart-title">
												<p><a href="{{ route('product.show', $item->product->slug) }}">{{ \Illuminate\Support\Str::limit($item->product->name, 30) }}</a></p>
											</div>
											<div class="cart-price">
												<p>{{ $item->quantity }} x ${{ number_format($item->product->final_price, 2) }}</p>
											</div>
											<form method="POST" action="{{ route('cart.remove', $item->id) }}" class="cart-remove-form">
												@csrf
												@method('DELETE')
												<button type="submit" style="border:none; background:none; color:#d9534f; cursor:pointer; padding:0; width:100%; height:100%;">
													<i class="fa fa-times"></i>
												</button>
											</form>
										</div>
									@empty
										<div class="single-cart" style="text-align:center; padding:20px;">
											<p>Your cart is empty</p>
										</div>
									@endforelse

									@if($globalCartItems->isNotEmpty())
										<div class="cart-bottom">
											<div class="cart-sub-total">
												<p>Total <span>${{ number_format($globalCartTotal, 2) }}</span></p>
											</div>
											<div class="cart-checkout">
												<a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>View Cart</a>
											</div>
											<div class="cart-share">
												<a href="{{ route('checkout') }}" class="checkout-btn"><i class="fa fa-share"></i>Checkout</a>
											</div>
										</div>
									@endif
								</div>
							</li>
								<li class="top-search">
									<a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i>
									</a>
									<form action="{{ route('collection') }}" method="GET" autocomplete="off">
										<input type="text" name="search" value="{{ request('search') }}" class="search-input" placeholder="Search" id="live-search-input">
										<div class="live-search-results" id="live-search-results"></div>
									</form>
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
							@if($siteSettings->logo)
								<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@else
								<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@endif
						</a>
					</div>
				</div>
				<div class="col-4">
					<div class="top-cart">
						<a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ({{ $globalCartCount }})</a>
						<div class="cart-drop">
							@forelse($globalCartItems as $item)
								<div class="single-cart">
									<div class="cart-img">
										<img alt="{{ $item->product->name }}" src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/car1.jpg') }}">
									</div>
									<div class="cart-title">
										<p><a href="{{ route('product.show', $item->product->slug) }}">{{ \Illuminate\Support\Str::limit($item->product->name, 30) }}</a></p>
									</div>
									<div class="cart-price">
										<p>{{ $item->quantity }} x ${{ number_format($item->product->final_price, 2) }}</p>
									</div>
									<form method="POST" action="{{ route('cart.remove', $item->id) }}" class="cart-remove-form">
										@csrf
										@method('DELETE')
										<button type="submit" style="border:none; background:none; color:#d9534f; cursor:pointer; padding:0; width:100%; height:100%;">
											<i class="fa fa-times"></i>
										</button>
									</form>
								</div>
							@empty
								<div class="single-cart" style="text-align:center; padding:20px;">
									<p>Your cart is empty</p>
								</div>
							@endforelse
							
							@if($globalCartItems->isNotEmpty())
								<div class="cart-bottom">
									<div class="cart-sub-total">
										<p>Total <span>${{ number_format($globalCartTotal, 2) }}</span></p>
									</div>
									<div class="cart-checkout">
										<a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>View Cart</a>
									</div>
									<div class="cart-share">
										<a href="{{ route('checkout') }}" class="checkout-btn"><i class="fa fa-share"></i>Checkout</a>
									</div>
								</div>
							@endif
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
							@if($siteSettings->logo)
								<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@else
								<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
							@endif
						</a></li>
					<li><a href="#" class="closeme"><i class="flaticon-close"></i></a></li>
					<li class="out-link {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>

					<li class="out-link {{ request()->is('collection*') || request()->is('product/*') ? 'active' : '' }}"><a href="{{ route('collection') }}">COLLECTION</a></li>

					<li class="out-link {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">CONTACT</a></li>


				</ul>
				<div class="mobile-login">
					<a href="{{ route('login') }}">Log in</a> |
					<a href="{{ route('register') }}">Create Account</a>
				</div>
				<form action="{{ route('collection') }}" method="GET" id="moble-search" autocomplete="off">
					<input name="search" value="{{ request('search') }}" placeholder="Search...." type="text" id="live-search-input-mobile">
					<button type="submit"><i class="fa fa-search"></i></button>
					<div class="live-search-results" id="live-search-results-mobile"></div>
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
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<div class="logo">
								<a href="{{ url('/') }}">
									@if($siteSettings->footer_logo)
										<img src="{{ asset('storage/' . $siteSettings->footer_logo) }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
									@elseif($siteSettings->logo)
										<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
									@else
										<img src="{{ asset('media/images/logo2.png') }}" alt="{{ $siteSettings->site_name ?? 'Rabie-Co' }}">
									@endif
								</a>
							</div>
							@if($siteSettings->footer_description)
								<p>{{ $siteSettings->footer_description }}</p>
							@endif
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>Quick Links</h3>
							<div class="footer-menu">
								<ul>
									<li><a href="{{ url('/') }}">Home</a></li>
									<li><a href="{{ route('collection') }}">All Products</a></li>
									<li><a href="{{ route('contact') }}">Contact Us</a></li>
									@auth
										<li><a href="{{ route('orders.index') }}">My Orders</a></li>
									@else
										<li><a href="{{ route('login') }}">Login</a></li>
									@endauth
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>Customer Service</h3>
							<div class="footer-menu">
								<ul>
									<li><a href="{{ route('contact') }}">Help & Support</a></li>
									<li><a href="{{ route('contact') }}">Shipping Info</a></li>
									<li><a href="{{ route('contact') }}">Returns & Exchanges</a></li>
									<li><a href="{{ route('contact') }}">Size Guide</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
						<div class="footer-widget">
							<h3>Follow Us</h3>
							<p>Stay connected with us on social media for the latest updates, news, and exclusive offers.</p>
							
							<!-- Professional Social Media Links -->
							@if($siteSettings->facebook_url || $siteSettings->instagram_url || $siteSettings->twitter_url || $siteSettings->linkedin_url || $siteSettings->youtube_url || $siteSettings->tiktok_url)
							<div class="social-media-section" style="margin-top: 20px;">
								<div class="social-icons-grid">
									@if($siteSettings->facebook_url)
										<a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener" class="social-facebook" title="Follow us on Facebook">
											<i class="fab fa-facebook-f"></i>
										</a>
									@endif
									@if($siteSettings->instagram_url)
										<a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener" class="social-instagram" title="Follow us on Instagram">
											<i class="fab fa-instagram"></i>
										</a>
									@endif
									@if($siteSettings->twitter_url)
										<a href="{{ $siteSettings->twitter_url }}" target="_blank" rel="noopener" class="social-twitter" title="Follow us on Twitter">
											<i class="fab fa-twitter"></i>
										</a>
									@endif
									@if($siteSettings->linkedin_url)
										<a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener" class="social-linkedin" title="Connect with us on LinkedIn">
											<i class="fab fa-linkedin-in"></i>
										</a>
									@endif
									@if($siteSettings->youtube_url)
										<a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener" class="social-youtube" title="Subscribe to our YouTube channel">
											<i class="fab fa-youtube"></i>
										</a>
									@endif
									@if($siteSettings->tiktok_url)
										<a href="{{ $siteSettings->tiktok_url }}" target="_blank" rel="noopener" class="social-tiktok" title="Follow us on TikTok">
											<i class="fab fa-tiktok"></i>
										</a>
									@endif
								</div>
							</div>
							@endif
						</div>
					</div>
					<!-- /.col-xl-3 -->
				</div>
			<div class="footer-bottom">
				<div class="row">
					<div class="col-12">
						<p>{{ $siteSettings->copyright_text ?? '© ' . date('Y') . ' Rabie-Co. All rights reserved.' }}</p>
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

	</div>
	<!-- /#site -->

	<!-- Checkout Modal Removed - Checkout now goes directly to checkout page -->

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
	<script src="{{ asset('dependencies/imagesloaded/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('dependencies/isotope-layout/js/isotope.pkgd.min.js') }}"></script>

	<!-- Fix will-change memory warning - Targeted approach -->
	<script>
		// Targeted will-change cleanup - only fix carousel/slider libraries
		(function() {
			'use strict';
			
			const removeWillChangeFromCarousels = () => {
				// Only target specific carousel/slider elements that abuse will-change
				const selectors = [
					'.owl-stage',
					'.owl-item',
					'.owl-carousel',
					'.slick-track',
					'.slick-slide',
					'.slick-list',
					'.grid-item',
					'.isotope-item',
					'.hero-slider',
					'.product-slider'
				];
				
				selectors.forEach(selector => {
					const elements = document.querySelectorAll(selector);
					elements.forEach(el => {
						if (el.style) {
							el.style.willChange = 'auto';
						}
					});
				});
			};
			
			// Run after DOM is ready and carousels are initialized
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', () => {
					setTimeout(removeWillChangeFromCarousels, 500);
				});
			} else {
				setTimeout(removeWillChangeFromCarousels, 500);
			}
			
			// Run once more after everything loads
			window.addEventListener('load', () => {
				setTimeout(removeWillChangeFromCarousels, 1000);
			}, { once: true });
		})();
	</script>
	<script src="{{ asset('dependencies/headroom/js/headroom.js') }}"></script>
	
	<!-- Site Scripts -->
	<script src="{{ asset('assets/js/app.js') }}"></script>

	<!-- Premium Motion System: scroll reveal + CTA glow (replaces AOS) -->
	<script>
		(function () {
			'use strict';

			var reduceMotion = window.matchMedia
				&& window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			/* ---- Scroll Reveal: single IntersectionObserver, ~80ms stagger ---- */
			document.addEventListener('DOMContentLoaded', function () {
				var revealEls = document.querySelectorAll('.reveal');

				// Reduced motion or no IO support → show everything immediately.
				if (reduceMotion || !('IntersectionObserver' in window)) {
					revealEls.forEach(function (el) { el.classList.add('reveal--in'); });
					return;
				}

				var observer = new IntersectionObserver(function (entries, obs) {
					entries.forEach(function (entry) {
						if (!entry.isIntersecting) return;
						var el = entry.target;
						// Stagger siblings revealed in the same frame.
						var delay = (Number(el.dataset.revealOrder) || 0) * 80;
						el.style.transitionDelay = delay + 'ms';
						el.classList.add('reveal--in');
						obs.unobserve(el); // reveal once, then stop observing
					});
				}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

				// Assign a stagger order within each parent group.
				var groups = new Map();
				revealEls.forEach(function (el) {
					var parent = el.parentElement;
					var idx = groups.get(parent) || 0;
					el.dataset.revealOrder = idx;
					groups.set(parent, idx + 1);
					observer.observe(el);
				});
			});

			/* ---- Hero CTA only: cursor glow + magnetic pull. rAF-throttled, no touch ----
			   Glow → CSS custom props track the cursor inside the button.
			   Magnet → button translates a fraction of the cursor's offset from its
			   center (capped), then springs back on mouseleave. transform-only. */
			document.addEventListener('DOMContentLoaded', function () {
				if (reduceMotion) return;
				var isTouch = window.matchMedia
					&& window.matchMedia('(hover: none), (pointer: coarse)').matches;
				if (isTouch) return; // skip on touch devices — no cursor to track

				var MAGNET_STRENGTH = 0.3;  // fraction of offset-from-center applied
				var MAGNET_MAX = 14;        // px cap so it stays subtle/premium

				var ctas = document.querySelectorAll('.cta-primary');
				ctas.forEach(function (cta) {
					var rafId = null;
					var glowX = 0, glowY = 0;   // cursor pos relative to top-left (glow)
					var pullX = 0, pullY = 0;   // capped magnetic translate

					function clamp(v, max) {
						return Math.max(-max, Math.min(max, v));
					}

					cta.addEventListener('mousemove', function (e) {
						var rect = cta.getBoundingClientRect();
						glowX = e.clientX - rect.left;
						glowY = e.clientY - rect.top;
						// Offset from the button's center drives the magnet.
						pullX = clamp((glowX - rect.width / 2) * MAGNET_STRENGTH, MAGNET_MAX);
						pullY = clamp((glowY - rect.height / 2) * MAGNET_STRENGTH, MAGNET_MAX);
						if (rafId) return;
						rafId = requestAnimationFrame(function () {
							cta.style.setProperty('--glow-x', glowX + 'px');
							cta.style.setProperty('--glow-y', glowY + 'px');
							cta.style.transform = 'translate3d(' + pullX + 'px,' + pullY + 'px,0)';
							rafId = null;
						});
					});

					cta.addEventListener('mouseleave', function () {
						// Spring back to rest (CSS transition does the easing).
						cta.style.transform = '';
					});
				});
			});
		})();

		// Fast page navigation with optimized transitions
		document.addEventListener('DOMContentLoaded', function() {
			// Add smooth scrolling to all anchor links
			const links = document.querySelectorAll('a[href^="#"]');
			links.forEach(link => {
				link.addEventListener('click', function(e) {
					const targetId = this.getAttribute('href');
					if (targetId === '#') return;
					
					const targetElement = document.querySelector(targetId);
					if (targetElement) {
						e.preventDefault();
						targetElement.scrollIntoView({
							behavior: 'smooth',
							block: 'start'
						});
					}
				});
			});

			// Fast page navigation for main navigation links
			const navLinks = document.querySelectorAll('#navigation a, #mobilemenu a');
			navLinks.forEach(link => {
				link.addEventListener('click', function(e) {
					const href = this.getAttribute('href');
					
					// Only handle internal links (not external or anchor links)
					if (href && href.startsWith('/') && !href.includes('#') && !href.includes('http')) {
						e.preventDefault();
						
						// Fast fade out effect
						document.body.style.transition = 'opacity 0.15s ease';
						document.body.style.opacity = '0.9';
						
						// Navigate immediately with minimal delay
						setTimeout(() => {
							window.location.href = href;
						}, 50);
					}
				});
			});

			// Fast transitions for page load
			window.addEventListener('load', function() {
				// Quick fade in effect
				document.body.style.transition = 'opacity 0.2s ease';
				document.body.style.opacity = '1';
			});

			// Add hover effects to navigation links
			navLinks.forEach(link => {
				link.addEventListener('mouseenter', function() {
					this.style.transform = 'translateY(-1px)';
					this.style.transition = 'all 0.15s ease';
				});
				
				link.addEventListener('mouseleave', function() {
					this.style.transform = 'translateY(0)';
				});
			});
		});

	</script>

	<!-- Checkout Confirmation Script -->
	<script>
		$(document).ready(function() {
			// Checkout buttons now work directly without modal interference
			// Removed the preventDefault() that was blocking checkout navigation
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

	<!-- Google Analytics -->
	@if($siteSettings->google_analytics_id)
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings->google_analytics_id }}"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '{{ $siteSettings->google_analytics_id }}');
		</script>
	@endif

	<!-- Google Tag Manager -->
	@if($siteSettings->google_tag_manager_id)
		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id={{ $siteSettings->google_tag_manager_id }}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		
		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','{{ $siteSettings->google_tag_manager_id }}');
		</script>
	@endif


</body>

</html>

