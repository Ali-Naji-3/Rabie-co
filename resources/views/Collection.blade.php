@extends('layouts.app')

@section('title', 'Collection - Softyskin')

@push('styles')
<style>
.mobile-view-switcher { gap: 8px; padding: 6px 0; }
.mobile-switch-btn {
    background: #f5f5f5;
    border: 2px solid #ddd;
    border-radius: 4px;
    padding: 7px 20px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s, color 0.2s;
    letter-spacing: 0.3px;
}
.mobile-switch-btn.active { background: #1b1b18; border-color: #1b1b18; color: #fff; }

/* Product card: override float-based theme layout for vertical stacking */
.sin-product.style-two .mid-wrapper h5.pro-title {
    float: none;
    width: 100%;
    display: block;
    clear: both;
}
.sin-product.style-two .mid-wrapper h5.pro-title a {
    white-space: normal;
    width: auto;
    overflow: visible;
    text-overflow: unset;
    display: block;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #111111;
}
.sin-product.style-two .mid-wrapper span {
    float: none;
}
.sin-product.style-two .mid-wrapper p {
    float: none !important;
    display: block !important;
    width: 100% !important;
    clear: both;
    text-align: center !important;
}
.sin-product.style-two .mid-wrapper > ul {
    float: none;
    clear: both;
    display: block;
    width: 100%;
    margin: 0;
}
.sin-product.style-two .mid-wrapper > ul > li {
    display: block !important;
    float: none !important;
    margin: 0 !important;
}

/* Eye icon: true center of image area */
.sin-product.style-two .pro-img .icon-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}
.sin-product.style-two .pro-img .pro-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: auto;
    text-align: center;
    pointer-events: auto;
}
.sin-product.style-two .pro-img .add-to-cart {
    pointer-events: auto;
}

@media (max-width: 767px) {
    #mobile-product-row .owl-dots { margin-top: 12px; text-align: center; }
    #mobile-product-row .owl-dots .owl-dot span { background: #ddd; }
    #mobile-product-row .owl-dots .owl-dot.active span { background: #1b1b18; }

    /* Owl 2.2.1 only sets -ms-touch-action; add standard property for iOS/Chrome */
    #mobile-product-row .owl-stage { touch-action: pan-y; }

    /* Owl manages carousel visibility — bypass vertical-scroll reveal animation */
    .owl-item .reveal,
    .owl-item .reveal.reveal--in {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
}
</style>
@endpush

@section('content')

		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="reveal breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{route('home')}}">Home  |</a> Shop</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Shop area          =-->
		<!--=========================-->

		<section class="reveal shop-area">
			<div class="container-fluid custom-container">
				<div class="row">

					<div class="col-12">
						<div class="reveal shop-sorting-area row">
							<div class="col-4 col-sm-4 col-md-6">
								<ul class="nav nav-tabs shop-btn" id="myTab" role="tablist">
									<li class="nav-item ">
										<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="flaticon-menu"></i></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="flaticon-list"></i></a>
									</li>
								</ul>
							</div>
							<!-- /.col-xl-6 -->
							<div class="col-12 col-sm-8 col-md-6">
								<div class="sort-by">
									<span>Sort by :</span>
									<select class="orderby" name="orderby">
								<option value="menu_order">Default sorting</option>
								<option value="popularity">Sort by popularity</option>
								<option value="rating">Sort by average rating</option>
								<option value="date">Sort by newness</option>
								<option selected="selected">Best Selling</option>
							</select>
								</div>
							</div>
							<!-- /.col-xl-6 -->
						</div>
						<!-- /.shop-sorting-area -->
						<div class="shop-content">
							<div class="tab-content" id="myTabContent">
								<!-- Grid View -->
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

									<!-- Mobile only: Carousel / List toggle -->
									<div class="d-flex d-md-none align-items-center justify-content-center mb-3 mobile-view-switcher">
										<button id="btn-mobile-carousel" class="mobile-switch-btn" type="button">
											<i class="fas fa-th-large"></i> Carousel
										</button>
										<button id="btn-mobile-list" class="mobile-switch-btn" type="button">
											<i class="fas fa-list"></i> List
										</button>
									</div>

									<div class="row" id="mobile-product-row">
										@forelse($products as $product)
										<div class="reveal col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product.show', $product->slug) }}">
														<img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/sp1.jpg') }}" 
															alt="{{ $product->name }}" 
															loading="lazy"
															style="max-width: 100%; height: auto;">
													</a>
													<div class="icon-wrapper">
														<div class="pro-icon">
															<ul>
																<li><a href="{{ route('product.show', $product->slug) }}"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
														<div class="add-to-cart">
															<form method="POST" action="{{ route('cart.add') }}">
																@csrf
																<input type="hidden" name="product_id" value="{{ $product->id }}">
																<input type="hidden" name="quantity" value="1">
																<button type="submit" style="background:none; border:none; color:inherit; cursor:pointer; width:100%;">
																	add to cart
																</button>
															</form>
														</div>
													</div>
												</div>
												@if($product->stock === 0)
													<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10;">OUT OF STOCK</span>
												@elseif($product->discount_percentage > 0)
													<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10; font-size: 14px; font-weight: bold; color: white;">{{ $product->discount_percentage }}% OFF</span>
												@endif
												<div class="mid-wrapper">
													@if($product->display_rating !== null)
														<div style="font-size: 13px; margin-bottom: 4px;">
															@for($i = 1; $i <= 5; $i++)
																<i class="fas fa-star" style="color: {{ $i <= round($product->display_rating) ? '#f39c12' : '#ccc' }};"></i>
															@endfor
															<span style="color: #555; font-weight: 600; margin-left: 3px;">{{ $product->display_rating }}</span>
															@if($product->display_review_count !== null)
																<span style="color: #888; font-size: 12px;">({{ number_format($product->display_review_count) }})</span>
															@endif
														</div>
													@endif
													<h5 class="pro-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h5>
													@include('partials.product-short-description', ['description' => $product->short_description])
													<div class="price-section">
														@if($product->discount_percentage > 0)
															<div class="mb-1">
																<span style="color: #e74c3c; font-size: 20px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 3px;">
																	${{ number_format($product->price, 2) }}
																</span>
															</div>
															<div class="mb-1">
																<span style="color: #27ae60; font-size: 26px; font-weight: bold; letter-spacing: 1px;">
																	${{ number_format($product->sale_price, 2) }}
																</span>
															</div>
														@else
															<div class="mb-1">
																<span style="color: #27ae60; font-size: 26px; font-weight: bold; letter-spacing: 1px;">
																	${{ number_format($product->price, 2) }}
																</span>
															</div>
														@endif
													</div>
												</div>
											</div>
										</div>
										@empty
										<div class="col-12 text-center py-5">
											<h4>No products found</h4>
											<p>Try adjusting your filters or search criteria.</p>
										</div>
										@endforelse
												</div>
									<!-- Pagination -->
									<div class="row mt-4">
										<div class="reveal col-12 d-flex justify-content-center">
											{{ $products->links() }}
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
								
								<!-- List View -->
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="row no-gutters">
										@forelse($products as $product)
										<div class="reveal col-xl-9">
											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<a href="{{ route('product.show', $product->slug) }}">
																<img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/lp1.jpg') }}" 
																	alt="{{ $product->name }}"
																	loading="lazy"
																	style="max-width: 100%; height: auto;">
															</a>
														</div>
														<div class="pro-icon">
															<ul>
																<li><a href="{{ route('product.show', $product->slug) }}"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<div class="rating">
																@if($product->display_rating !== null)
																	<ul>
																		@for($i = 1; $i <= 5; $i++)
																			<li><i class="fas fa-star {{ $i <= round($product->display_rating) ? 'text-warning' : 'text-muted' }}"></i></li>
																		@endfor
																	</ul>
																	<span style="font-size: 13px; color: #555; font-weight: 600;">{{ $product->display_rating }}</span>
																	@if($product->display_review_count !== null)
																		<span style="font-size: 12px; color: #888;">({{ number_format($product->display_review_count) }})</span>
																	@endif
																@endif
															</div>
															<h5 class="pro-title" style="font-size: 22px; font-weight: 900; color: #222; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
																<a href="{{ route('product.show', $product->slug) }}" style="color: #222; text-decoration: none; font-weight: 900;">{{ $product->name }}</a>
															</h5>
														<div class="price-section">
															@if($product->discount_percentage > 0)
																<div class="mb-1">
																	<span style="color: #e74c3c; font-size: 22px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 3px;">
																		${{ number_format($product->price, 2) }}
																	</span>
																</div>
																<div class="mb-1">
																	<span style="color: #27ae60; font-size: 28px; font-weight: bold; letter-spacing: 1px;">
																		${{ number_format($product->sale_price, 2) }}
																	</span>
																</div>
															@else
																<div class="mb-1">
																	<span style="color: #27ae60; font-size: 28px; font-weight: bold; letter-spacing: 1px;">
																		${{ number_format($product->price, 2) }}
																	</span>
																</div>
															@endif
														</div>
															@include('partials.product-short-description', ['description' => $product->short_description])
															<div class="pro-btn">
																<form method="POST" action="{{ route('cart.add') }}" style="display:inline;">
																	@csrf
																	<input type="hidden" name="product_id" value="{{ $product->id }}">
																	<input type="hidden" name="quantity" value="1">
																	<button type="submit" class="btn-two" style="cursor:pointer; border:none;">Add to cart</button>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
														</div>
										@empty
										<div class="col-12 text-center py-5">
											<h4>No products found</h4>
														</div>
										@endforelse
													</div>
									<!-- Pagination -->
									<div class="row mt-4">
										<div class="reveal col-12 d-flex justify-content-center">
											{{ $products->links() }}
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.shop-content -->
					</div>
					<!-- /.col-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.shop-area -->

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    var $row = $('#mobile-product-row');
    var owlActive = false;

    function applyCarousel() {
        if (owlActive) return;
        $row.find('.reveal').addClass('reveal--in');
        $row.removeClass('row');
        $row.owlCarousel({
            items: 1,
            loop: false,
            dots: true,
            nav: false,
            margin: 10,
            stagePadding: 30,
            mouseDrag: true,
            touchDrag: true,
            pullDrag: true,
            smartSpeed: 400
        });
        // Must add owl-carousel AFTER init: Owl calculates dimensions while visible,
        // then owl-carousel class unlocks the CSS layout rules (float:left on items,
        // overflow:hidden on stage-outer). owl-loaded is already set so display:block wins.
        $row.addClass('owl-carousel');
        owlActive = true;
        $('#btn-mobile-carousel').addClass('active');
        $('#btn-mobile-list').removeClass('active');
        localStorage.setItem('softyskin_mobile_view', 'carousel');
    }

    function applyList() {
        if (owlActive) {
            $row.trigger('destroy.owl.carousel');
            $row.removeClass('owl-carousel').addClass('row');
            owlActive = false;
        }
        $('#btn-mobile-list').addClass('active');
        $('#btn-mobile-carousel').removeClass('active');
        localStorage.setItem('softyskin_mobile_view', 'list');
    }

    function destroyForDesktop() {
        if (owlActive) {
            $row.trigger('destroy.owl.carousel');
            $row.removeClass('owl-carousel');
            owlActive = false;
        }
        if (!$row.hasClass('row')) {
            $row.addClass('row');
        }
    }

    function applyMobile() {
        var saved = localStorage.getItem('softyskin_mobile_view') || 'carousel';
        saved === 'carousel' ? applyCarousel() : applyList();
    }

    var mobileQuery = window.matchMedia('(max-width: 767px)');

    function onBreakpointChange(e) {
        if (e.matches) {
            applyMobile();
        } else {
            destroyForDesktop();
        }
    }

    if (mobileQuery.matches) {
        applyMobile();
    }

    if (mobileQuery.addEventListener) {
        mobileQuery.addEventListener('change', onBreakpointChange);
    } else {
        mobileQuery.addListener(onBreakpointChange);
    }

    $('#btn-mobile-carousel').on('click', applyCarousel);
    $('#btn-mobile-list').on('click', applyList);
});
</script>
@endpush
