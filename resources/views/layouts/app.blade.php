<!doctype html>
<html>

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https://maps.googleapis.com https://maps.gstatic.com https://fonts.googleapis.com https://fonts.gstatic.com https://fonts.bunny.net https://unpkg.com; img-src 'self' data: blob: https:; connect-src 'self' https://maps.googleapis.com https://maps.gstatic.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com https://fonts.bunny.net; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://unpkg.com; font-src 'self' data: https://fonts.gstatic.com https://fonts.bunny.net;">
	
	<!-- SEO Meta Tags -->
	<title>@yield('title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Softyskin Fashion Store')</title>
	<meta name="description" content="@yield('description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Softyskin. Premium clothing, accessories, and exclusive collections.')">
	<meta name="keywords" content="@yield('keywords', $siteSettings->meta_keywords ?? 'fashion, clothing, accessories, online store, premium brands, style')">
	<meta name="author" content="{{ $siteSettings->site_name ?? 'Softyskin' }}">
	<meta name="robots" content="index, follow">
	
	<!-- Open Graph Meta Tags (Social Media) -->
	<meta property="og:title" content="@yield('og_title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Softyskin Fashion Store')">
	<meta property="og:description" content="@yield('og_description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Softyskin. Premium clothing, accessories, and exclusive collections.')">
	<meta property="og:image" content="@yield('og_image', $siteSettings->og_image ? asset('storage/' . $siteSettings->og_image) : asset('media/images/logo.png'))">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="{{ $siteSettings->site_name ?? 'Softyskin' }}">
	
	<!-- Twitter Card Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('og_title', $siteSettings->meta_title ?? $siteSettings->site_name ?? 'Softyskin Fashion Store')">
	<meta name="twitter:description" content="@yield('og_description', $siteSettings->meta_description ?? $siteSettings->site_description ?? 'Shop the latest fashion trends at Softyskin.')">
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

	@stack('head_links')

	<!-- Dependency Styles -->
	<link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/fontawesome/css/fontawesome-all.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.carousel.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.theme.default.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('dependencies/flaticon/css/flaticon.css') }}" type="text/css">

	<!-- Google Fonts for Luxury Design -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Site Stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">

	<!-- Luxury Design System Styles -->
	<style>
		:root {
			--luxe-gold: #c29b67;
			--luxe-black: #1b1b18;
			--luxe-cream: #f9f5f0;
			--luxe-gray: #7d7d7d;
			--luxe-border: #eee;
			--luxe-shadow: 0 10px 30px rgba(0,0,0,0.05);
		}

		body {
			background: #fff;
			color: var(--luxe-black);
			font-family: 'Inter', sans-serif;
		}

		.luxe-serif { font-family: 'Cormorant Garamond', serif; }
		.luxe-sans { font-family: 'Inter', sans-serif; }

		/* Header Styles */
		.header-area {
			background: #fff;
			padding: 25px 0;
			position: relative;
			z-index: 1000;
		}

		.nav-pill-wrapper {
			background: #fff;
			border-radius: 50px;
			box-shadow: var(--luxe-shadow);
			display: inline-flex;
			align-items: center;
			padding: 8px 12px;
			border: 1px solid #f0f0f0;
		}

		.nav-pill-wrapper ul {
			display: flex;
			list-style: none;
			margin: 0;
			padding: 0;
			gap: 10px;
		}

		.nav-pill-wrapper ul li a {
			padding: 10px 25px;
			border-radius: 40px;
			font-size: 13px;
			font-weight: 700;
			text-transform: uppercase;
			color: var(--luxe-black);
			transition: all 0.3s ease;
			letter-spacing: 0.05em;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.nav-pill-wrapper ul li a:hover,
		.nav-pill-wrapper ul li a.active {
			background: #fff;
			color: var(--luxe-gold);
		}

		.nav-pill-wrapper ul li a.active {
			box-shadow: 0 4px 15px rgba(0,0,0,0.08);
			position: relative;
		}
		
		#header .logo img {
			max-height: 45px;
		}

		.header-right-luxe {
			display: flex;
			align-items: center;
			justify-content: flex-end;
			gap: 25px;
		}

		.header-right-luxe .icon-link {
			color: var(--luxe-black);
			font-size: 18px;
			transition: color 0.3s ease;
		}

		.header-right-luxe .icon-link:hover {
			color: var(--luxe-gold);
		}

		.my-orders-link {
			font-size: 13px;
			font-weight: 600;
			color: var(--luxe-black);
			text-transform: uppercase;
			letter-spacing: 0.05em;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.currency-switcher-luxe {
			background: #f5f5f5;
			border-radius: 30px;
			display: flex;
			padding: 4px;
		}

		.currency-btn {
			background: transparent;
			border: none;
			padding: 6px 15px;
			border-radius: 20px;
			font-size: 12px;
			font-weight: 700;
			color: #888;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.currency-btn.active {
			background: #fff;
			color: var(--luxe-black);
			box-shadow: 0 2px 8px rgba(0,0,0,0.05);
		}

		.user-avatar-luxe {
			width: 38px;
			height: 38px;
			border-radius: 50%;
			background: #fdf2e9;
			color: #e67e22;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			font-size: 14px;
			text-decoration: none !important;
		}

		.cart-pill-luxe {
			background: var(--luxe-gold);
			color: #fff;
			padding: 8px 20px;
			border-radius: 30px;
			font-weight: 700;
			font-size: 14px;
			display: flex;
			align-items: center;
			gap: 10px;
			box-shadow: 0 4px 15px rgba(194, 155, 103, 0.3);
			transition: transform 0.3s ease;
		}

		.cart-pill-luxe:hover {
			transform: translateY(-2px);
			color: #fff;
		}

		.luxe-dropdown {
			position: absolute;
			top: 100%;
			right: 0;
			background: #fff;
			border-radius: 12px;
			box-shadow: 0 15px 50px rgba(0,0,0,0.1);
			min-width: 280px;
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s ease;
			transform: translateY(10px);
			padding: 20px;
			border: 1px solid #f0f0f0;
		}

		.user-login:hover .luxe-dropdown,
		.top-cart:hover .luxe-dropdown,
		.top-search:hover .luxe-dropdown,
		.top-search .luxe-dropdown.search-open {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}

		/* Live search suggestions dropdown */
		.live-search-results {
			display: none;
			position: absolute;
			top: calc(100% + 8px);
			left: 0;
			right: 0;
			background: #fff;
			border: 1px solid #f0f0f0;
			border-radius: 10px;
			box-shadow: 0 15px 50px rgba(0,0,0,0.12);
			max-height: 360px;
			overflow-y: auto;
			z-index: 1080;
		}

		.live-search-results.is-open {
			display: block;
		}

		.live-search-item {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 10px 14px;
			color: #1b1b18;
			text-decoration: none;
			border-bottom: 1px solid #f5f5f5;
		}

		.live-search-item:last-child {
			border-bottom: none;
		}

		.live-search-item:hover {
			background: #fdfbf7;
		}

		.live-search-item img {
			width: 44px;
			height: 44px;
			object-fit: cover;
			border-radius: 6px;
			flex-shrink: 0;
		}

		.live-search-item .ls-name {
			flex: 1;
			font-size: 14px;
			font-weight: 600;
			line-height: 1.3;
		}

		.live-search-item .ls-price {
			font-size: 13px;
			font-weight: 700;
			color: #c29b67;
			white-space: nowrap;
		}

		.live-search-empty {
			padding: 14px;
			font-size: 13px;
			color: #7d7d7d;
			text-align: center;
		}

		.luxe-separator {
			width: 1px;
			height: 24px;
			background: #eee;
			margin: 0 10px;
		}

		/* Responsive Adjustments */
		@media (max-width: 1199px) {
			.nav-pill-wrapper { padding: 4px 8px; }
			.nav-pill-wrapper ul li a { padding: 8px 15px; font-size: 12px; }
			.header-right-luxe { gap: 15px; }
		}

		@media (max-width: 991px) {
			.header-area { padding: 15px 0; }
			.menu-container { display: none; }
		}
	</style>

	@stack('styles')
	
	@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body id="home-version-1" class="home-version-1" data-style="default">

@if(session('success') || session('error'))
	<div id="flash-toast" class="flash-toast flash-toast--{{ session('success') ? 'success' : 'error' }}" role="status" aria-live="polite">
		<i class="fas fa-{{ session('success') ? 'check-circle' : 'exclamation-circle' }}" aria-hidden="true"></i>
		<span>{{ session('success') ?? session('error') }}</span>
	</div>
@endif

	<div class="site-content">

		<!--=========================-->
		<!--=        Header         =-->
		<!--=========================-->

		<header id="header" class="header-area">
			<div class="container custom-container">
				<div class="row align-items-center">
					<!-- Logo Area -->
					<div class="col-lg-2 col-md-4 col-6">
						<div class="logo">
							<a href="{{ url('/') }}">
								@if($siteSettings->logo)
									<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
								@else
									<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
								@endif
							</a>
						</div>
					</div>

					<!-- Navigation Pill Area -->
					<div class="col-lg-6 d-none d-lg-flex justify-content-center">
						<div class="nav-pill-wrapper">
							<ul id="navigation">
								<li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">HOME</a></li>
								<li><a href="{{ route('collection') }}" class="{{ request()->is('collection*') || request()->is('product/*') ? 'active' : '' }}">COLLECTION</a></li>
								<li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">CONTACT</a></li>
							</ul>
						</div>
					</div>

					<!-- Right Action Area -->
					<div class="col-lg-4 col-md-8 col-6">
						<div class="header-right-luxe">
							<!-- Search -->
							<div class="top-search d-flex align-items-center">
								<a href="javascript:void(0)" class="icon-link"><i class="fa fa-search"></i></a>
								<div class="luxe-dropdown" style="min-width: 350px;">
									<form action="{{ route('collection') }}" method="GET" autocomplete="off">
										<div class="position-relative">
											<input type="text" name="search" value="{{ request('search') }}" class="luxe-input" placeholder="Search products..." id="live-search-input" style="width: 100%;">
											<div class="live-search-results" id="live-search-results"></div>
										</div>
									</form>
								</div>
							</div>

							<div class="luxe-separator d-none d-xl-block"></div>

							<!-- My Orders -->
							@auth
								@php
									$userHasOrders = \App\Models\Order::where('user_id', auth()->id())->exists();
								@endphp
								@if($userHasOrders)
									<a href="{{ route('orders.index') }}" class="my-orders-link d-none d-xl-flex">
										<i class="fa fa-calendar-check"></i> My Orders
									</a>
									<div class="luxe-separator d-none d-xl-block"></div>
								@endif
							@endauth

							<!-- Currency Switcher -->
							@if($currencyService->hasEgpRate())
								<div class="currency-switcher-luxe d-none d-md-flex">
									<form method="POST" action="{{ route('currency.set') }}" class="m-0">
										@csrf
										<input type="hidden" name="currency" value="USD">
										<button type="submit" class="currency-btn {{ $activeCurrency === 'USD' ? 'active' : '' }}">USD</button>
									</form>
									<form method="POST" action="{{ route('currency.set') }}" class="m-0">
										@csrf
										<input type="hidden" name="currency" value="EGP">
										<button type="submit" class="currency-btn {{ $activeCurrency === 'EGP' ? 'active' : '' }}">EGP</button>
									</form>
								</div>
								<div class="luxe-separator d-none d-md-block"></div>
							@endif

							<!-- User -->
							<div class="user-login position-relative d-flex align-items-center">
								@auth
									<a href="#" class="user-avatar-luxe">
										{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
									</a>
									<div class="luxe-dropdown">
										<div class="p-2">
											<p class="font-weight-bold mb-3 pb-3 border-bottom luxe-sans" style="font-size: 15px;">
												Hello, {{ auth()->user()->name }}
											</p>
											@if(auth()->user()->role === 'admin')
												<a href="/admin" class="d-block py-2 text-dark"><i class="fa fa-shield-alt mr-2 text-muted"></i> Admin Dashboard</a>
											@endif
											<a href="{{ route('orders.index') }}" class="d-block py-2 text-dark"><i class="fa fa-list-alt mr-2 text-muted"></i> My Orders</a>
											<a href="{{ route('cart') }}" class="d-block py-2 text-dark"><i class="fa fa-shopping-cart mr-2 text-muted"></i> My Cart</a>
											<form method="POST" action="{{ route('logout') }}" class="m-0 border-top mt-3 pt-3">
												@csrf
												<button type="submit" class="border-0 bg-transparent text-danger p-0 luxe-sans font-weight-bold">
													<i class="fa fa-sign-out-alt mr-2"></i> Logout
												</button>
											</form>
										</div>
									</div>
								@else
									<a href="{{ route('login') }}" class="icon-link"><i class="fa fa-user"></i></a>
								@endauth
							</div>

							<!-- Cart -->
							<div class="top-cart position-relative">
								<a href="javascript:void(0)" class="cart-pill-luxe">
									<i class="fa fa-shopping-cart"></i>
									<span class="cart-count">({{ $globalCartCount }})</span>
								</a>
								<div class="luxe-dropdown" style="min-width: 320px;">
									@forelse($globalCartItems as $item)
										<div class="d-flex align-items-center mb-3 pb-3 border-bottom position-relative">
											<div class="mr-3" style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; background: #f8f9fa;">
												<img alt="{{ $item->product->name }}" src="{{ $item->product->primary_image ? asset('storage/' . $item->product->primary_image) : asset('media/images/product/car1.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;">
											</div>
											<div class="flex-grow-1">
												<h6 class="mb-1 luxe-sans" style="font-size: 13px;"><a href="{{ route('product.show', $item->product->slug) }}" class="text-dark">{{ \Illuminate\Support\Str::limit($item->product->name, 25) }}</a></h6>
												<p class="mb-0 text-muted" style="font-size: 12px;">{{ $item->quantity }} × @price($item->product->final_price)</p>
											</div>
											<form method="POST" action="{{ route('cart.remove', $item->id) }}" class="m-0 position-absolute" style="top: 0; right: 0;">
												@csrf @method('DELETE')
												<button type="submit" class="border-0 bg-transparent text-danger p-0" title="Remove"><i class="fa fa-times" style="font-size: 12px;"></i></button>
											</form>
										</div>
									@empty
										<div class="text-center py-4">
											<i class="fa fa-shopping-basket fa-2x text-light mb-3"></i>
											<p class="text-muted mb-0 luxe-sans">Your cart is empty</p>
										</div>
									@endforelse

									@if($globalCartItems->isNotEmpty())
										<div class="pt-3">
											<div class="d-flex justify-content-between mb-3">
												<span class="text-muted">Total:</span>
												<span class="font-weight-bold luxe-gold">@price($globalCartTotal)</span>
											</div>
											<div class="row no-gutters gap-2">
												<div class="col-6 pr-1">
													<a href="{{ route('cart') }}" class="btn btn-block btn-outline-dark btn-sm rounded-pill py-2">View Cart</a>
												</div>
												<div class="col-6 pl-1">
													<a href="{{ route('checkout') }}" class="btn btn-block btn-dark btn-sm rounded-pill py-2">Checkout</a>
												</div>
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
								<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
							@else
								<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
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
										<p>{{ $item->quantity }} x @price($item->product->final_price)</p>
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
										<p>Total <span>@price($globalCartTotal)</span></p>
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
								<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
							@else
								<img src="{{ asset('media/images/logo.png') }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
							@endif
						</a></li>
					<li><a href="#" class="closeme"><i class="flaticon-close"></i></a></li>
					<li class="out-link {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>

					<li class="out-link {{ request()->is('collection*') || request()->is('product/*') ? 'active' : '' }}"><a href="{{ route('collection') }}">COLLECTION</a></li>

					<li class="out-link {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">CONTACT</a></li>


				</ul>
				@if($currencyService->hasEgpRate())
				<div style="padding: 10px 15px; border-top: 1px solid #eee; display: flex; align-items: center; gap: 8px;">
					<span style="font-size: 12px; color: #666; font-weight: 600;">Currency:</span>
					<form method="POST" action="{{ route('currency.set') }}" style="margin:0; display:inline;">
						@csrf
						<input type="hidden" name="currency" value="USD">
						<button type="submit" style="padding: 4px 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 12px; font-weight: 700; cursor: pointer; {{ $activeCurrency === 'USD' ? 'background:#1b1b18; color:#fff; border-color:#1b1b18;' : 'background:#fff; color:#555;' }}">USD</button>
					</form>
					<form method="POST" action="{{ route('currency.set') }}" style="margin:0; display:inline;">
						@csrf
						<input type="hidden" name="currency" value="EGP">
						<button type="submit" style="padding: 4px 10px; border: 1px solid #ddd; border-radius: 3px; font-size: 12px; font-weight: 700; cursor: pointer; {{ $activeCurrency === 'EGP' ? 'background:#1b1b18; color:#fff; border-color:#1b1b18;' : 'background:#fff; color:#555;' }}">EGP</button>
					</form>
				</div>
				@endif
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
										<img src="{{ asset('storage/' . $siteSettings->footer_logo) }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
									@elseif($siteSettings->logo)
										<img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
									@else
										<img src="{{ asset('media/images/logo2.png') }}" alt="{{ $siteSettings->site_name ?? 'Softyskin' }}">
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
						<p>{{ $siteSettings->copyright_text ?? '© ' . date('Y') . ' Softyskin. All rights reserved.' }}</p>
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

	<script>
		// Live search autocomplete — wires the existing inputs to the existing
		// search.suggestions endpoint. No routes/controllers changed.
		(function () {
			var endpoint = "{{ route('search.suggestions') }}";

			function escapeHtml(value) {
				return String(value)
					.replace(/&/g, '&amp;').replace(/</g, '&lt;')
					.replace(/>/g, '&gt;').replace(/"/g, '&quot;');
			}

			function render(results, item) {
				if (!Array.isArray(results) || results.length === 0) {
					results.length = 0;
					item.innerHTML = '<div class="live-search-empty">No products found</div>';
					item.classList.add('is-open');
					return;
				}
				item.innerHTML = results.map(function (p) {
					return '<a class="live-search-item" href="' + escapeHtml(p.url) + '">' +
						'<img src="' + escapeHtml(p.image) + '" alt="">' +
						'<span class="ls-name">' + escapeHtml(p.name) + '</span>' +
						'<span class="ls-price">' + escapeHtml(p.price) + '</span>' +
						'</a>';
				}).join('');
				item.classList.add('is-open');
			}

			function wire(inputId, resultsId) {
				var input = document.getElementById(inputId);
				var results = document.getElementById(resultsId);
				if (!input || !results) return;

				var timer = null;
				var dropdown = input.closest('.luxe-dropdown');

				input.addEventListener('focus', function () {
					if (dropdown) dropdown.classList.add('search-open');
				});

				input.addEventListener('input', function () {
					var term = input.value.trim();
					if (timer) clearTimeout(timer);

					if (term.length < 2) {
						results.classList.remove('is-open');
						results.innerHTML = '';
						return;
					}

					timer = setTimeout(function () {
						fetch(endpoint + '?q=' + encodeURIComponent(term), {
							headers: { 'Accept': 'application/json' }
						})
							.then(function (r) { return r.ok ? r.json() : []; })
							.then(function (data) { render(data, results); })
							.catch(function () {
								results.classList.remove('is-open');
								results.innerHTML = '';
							});
					}, 250);
				});

				// Hide results when clicking outside this search box.
				document.addEventListener('click', function (e) {
					if (!results.contains(e.target) && e.target !== input) {
						results.classList.remove('is-open');
						if (dropdown && !dropdown.contains(e.target)) {
							dropdown.classList.remove('search-open');
						}
					}
				});
			}

			wire('live-search-input', 'live-search-results');
			wire('live-search-input-mobile', 'live-search-results-mobile');
		})();
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

