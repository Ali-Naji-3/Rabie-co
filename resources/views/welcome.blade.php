@extends('layouts.app')

@section('title', 'Softyskin - Home')

@section('content')

	<!--=========================-->
	<!--=        Slider         =-->
	<!--=========================-->

	<section class="slider-wrapper">
		<div class="aurora" aria-hidden="true"></div>
		<div class="slider-start slider-1 owl-carousel owl-theme">

		@forelse($heroSliders as $slider)
		<div class="item" style="position: relative;">
			@if($slider->media_type === 'video')
				{{-- Video Slider --}}
				@if($slider->video_url)
					{{-- External Video (YouTube/Vimeo) --}}
					@php
						$videoId = '';
						$videoType = '';
						if (strpos($slider->video_url, 'youtube.com') !== false || strpos($slider->video_url, 'youtu.be') !== false) {
							preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $slider->video_url, $matches);
							$videoId = $matches[1] ?? '';
							$videoType = 'youtube';
						} elseif (strpos($slider->video_url, 'vimeo.com') !== false) {
							preg_match('/vimeo\.com\/(\d+)/', $slider->video_url, $matches);
							$videoId = $matches[1] ?? '';
							$videoType = 'vimeo';
						}
					@endphp
					
					@if($videoType === 'youtube' && $videoId)
						<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
							<iframe 
								src="https://www.youtube.com/embed/{{ $videoId }}?{{ $slider->autoplay ? 'autoplay=1&' : '' }}{{ $slider->loop ? 'loop=1&playlist=' . $videoId . '&' : '' }}{{ $slider->muted ? 'mute=1&' : '' }}{{ $slider->show_controls ? '' : 'controls=0&' }}rel=0&modestbranding=1" 
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
								allowfullscreen>
							</iframe>
						</div>
					@elseif($videoType === 'vimeo' && $videoId)
						<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
							<iframe 
								src="https://player.vimeo.com/video/{{ $videoId }}?{{ $slider->autoplay ? 'autoplay=1&' : '' }}{{ $slider->loop ? 'loop=1&' : '' }}{{ $slider->muted ? 'muted=1&' : '' }}{{ $slider->show_controls ? '' : 'controls=0&' }}" 
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
								allow="autoplay; fullscreen; picture-in-picture" 
								allowfullscreen>
							</iframe>
						</div>
					@endif
				@elseif($slider->video)
					{{-- Uploaded Video File --}}
					<video 
						style="width: 100%; height: 100%; object-fit: cover; display: block;"
						{{ $slider->autoplay ? 'autoplay' : '' }}
						{{ $slider->loop ? 'loop' : '' }}
						{{ $slider->muted ? 'muted' : '' }}
						{{ $slider->show_controls ? 'controls' : '' }}
						{{ $slider->video_thumbnail ? 'poster=' . asset('storage/' . $slider->video_thumbnail) : '' }}
						playsinline>
						<source src="{{ asset('storage/' . $slider->video) }}" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				@endif
			@else
				{{-- Image Slider --}}
				@if($slider->image)
					<img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->main_title }}" style="width: 100%; display: block;">
				@endif
			@endif
			<div class="container-fluid custom-container slider-content">
					<div class="row align-items-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
							<div class="slider-text" style="{{ $slider->text_alignment === 'center' ? 'text-align: center;' : ($slider->text_alignment === 'right' ? 'text-align: right;' : '') }}">
								@if($slider->small_title)
								<h4 class="animated {{ $slider->animation }}" style="color: {{ $slider->text_color }}">
									<span>{{ $slider->small_title }}</span>
								</h4>
								@endif
								<h1 class="animated {{ $slider->animation }}" style="color: {{ $slider->text_color }}">
									{{ $slider->main_title }}
								</h1>
								@if($slider->description)
								<p class="animated {{ $slider->animation }}" style="color: {{ $slider->text_color }}">
									{{ $slider->description }}
								</p>
								@endif
								<a class="animated {{ $slider->animation }} btn-two cta-primary" href="{{ $slider->button_link }}">
									{{ $slider->button_text }}
								</a>
							</div>
						</div>
						<!-- Col End -->
					</div>
					<!-- Row End -->
				</div>
			</div>
			@empty
		<!-- Fallback to default slider if no sliders in database -->
		<div class="item">
			<img src="{{ asset('media/images/banner/f1.jpg') }}" alt="" style="width: 100%; display: block;">
			<div class="container-fluid custom-container slider-content">
					<div class="row align-items-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
							<div class="slider-text">
								<h4 class="animated fadeInUp"><span>CLEAN</span> SKINCARE</h4>
								<h1 class="animated fadeInUp">{{ $siteSettings->site_name ?? 'Softyskin' }}</h1>
								<p class="animated fadeInUp">Gentle, effective skincare for healthy, glowing skin. Discover formulas your skin will love.</p>
								<a class="animated fadeInUp btn-two cta-primary" href="{{ route('collection') }}">SHOP NOW</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforelse

		</div>
	</section>
	<!-- Slides end -->

	<!--=========================-->
	<!--=   Feature Icons (Dynamic)   =-->
	<!--=========================-->

	@if($featureIcons->count() > 0)
	<section class="reveal feature-icons-section" style="padding: 60px 0; background: #f8f9fa;">
		<div class="container">
			<div class="row">
				@foreach($featureIcons as $feature)
				<div class="reveal col-6 col-md-3 mb-4">
					<div class="feature-icon-box text-center" style="padding: 30px 15px; background: {{ $feature->background_color ?? 'transparent' }}; border-radius: 8px; transition: all 0.3s ease;">
						@if($feature->link_url)
							<a href="{{ $feature->link_url }}" {{ $feature->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="text-decoration: none; color: inherit;">
						@endif
						
						<div class="feature-icon mb-3" style="font-size: {{ $feature->icon_size }}px; color: {{ $feature->icon_color }};">
							@if($feature->icon_type === 'image' && $feature->icon_image)
								<img src="{{ asset('storage/' . $feature->icon_image) }}" alt="{{ $feature->title }}" style="width: {{ $feature->icon_size }}px; height: {{ $feature->icon_size }}px; object-fit: contain;">
							@else
								<i class="{{ $feature->icon_class }}"></i>
							@endif
						</div>
						
						<h4 style="font-size: 18px; font-weight: 700; margin-bottom: 10px; color: {{ $feature->text_color }};">
							{{ $feature->title }}
						</h4>
						
						@if($feature->description)
						<p style="font-size: 14px; color: {{ $feature->text_color }}; opacity: 0.8; margin: 0;">
							{{ $feature->description }}
						</p>
						@endif
						
						@if($feature->link_url)
							</a>
						@endif
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif

	<!--=========================-->
	<!--=   Shop by Category (Dynamic)   =-->
	<!--=========================-->

	{{-- Visibility guard: only categories that have products AND a real image render.
	     Demo categories (Electronics/Clothing/Home & Garden) have no image, so the whole
	     section stays hidden until real skincare categories with images are added in admin —
	     at which point it appears automatically with no code change. --}}
	@php($shopCategories = $categories->where('products_count', '>', 0)->filter(fn ($category) => filled($category->image)))
	@if($shopCategories->isNotEmpty())
	<section class="reveal category-discovery-section">
		<div class="container container-two">
			<div class="reveal section-heading">
				<h3>Shop by <span>Category</span></h3>
			</div>
			<div class="row">
				@foreach($shopCategories as $category)
				<div class="reveal col-6 col-md-4 col-lg-3 mb-4">
					<a href="{{ route('collection', ['category' => $category->id]) }}" class="category-tile">
						@if($category->image)
							<img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" loading="lazy" class="category-tile-img">
						@else
							<span class="category-tile-fallback" aria-hidden="true">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
						@endif
						<span class="category-tile-name">{{ $category->name }}</span>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif

	<!--=========================-->
	<!--=        Product Filter      =-->
	<!--=========================-->

	<section class="reveal main-product">
		<div class="container container-two">
			<div class="reveal section-heading">
				<h3>Featured <span>Products</span></h3>
			</div>
			<!-- /.section-heading-->
			<div class="row">
				<div class="col-xl-12 ">
						<div class="row g-2 g-md-4">
							@forelse($featuredProducts as $product)
								<!-- single product -->
								<div class="reveal col-6 col-md-4 col-xl-3 mb-4">
									<div style="width: 100%; height: 100%;">
										@include('partials.product-card', ['product' => $product])
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
			<div class="row">
				<div class="col-12 text-center" style="margin-top: 20px;">
					<a class="btn-two cta-primary" href="{{ route('collection') }}">SHOP ALL PRODUCTS</a>
				</div>
			</div>
		</div>
		<!-- Container  -->
	</section>
	<!-- main-product -->

	<!--=========================-->
	<!--=   Homepage Sections (after_products)   =-->
	<!--=========================-->

	@foreach(($homepageSections['after_products'] ?? []) as $section)
		@include('partials.homepage-section', ['section' => $section])
	@endforeach

	<!--=========================-->
	<!--=   Comparison Table UI   =-->
	<!--=========================-->
	@include('partials.comparison-table-static')

	<!--=========================-->
	<!--=   FAQ Section (Dynamic)   =-->
	<!--=========================-->
	@include('partials.home-faq')

	<!--=========================-->
	<!--=   Small Product area    =-->
	<!--=========================-->

	@if($featuredReviews->isNotEmpty())
	<section class="reveal product-small">
		<div class="container-fluid  custom-container">
			<div class="row">
				<div class="col-12">
					<div class="reveal small-sec-title text-center">
						<h6><span style="color: #FFD700;">⭐ FEATURED CUSTOMER REVIEWS</span></h6>
						<p style="color: #666; font-size: 14px; margin-top: 10px;">See what our customers are saying about their favorite products</p>
					</div>
				</div>
			</div>
			
			<div class="row">
				@foreach($featuredReviews as $review)
				<div class="reveal col-lg-4 col-md-6 col-sm-12 mb-4">
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
									<img src="{{ $review->product->primary_image ? asset('storage/' . $review->product->primary_image) : asset('media/images/product/1.jpg') }}"
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
								<i class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}" style="color: {{ $i <= $review->rating ? '#FFD700' : '#ddd' }}; font-size: 18px;"></i>
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
							<div class="reviewer-avatar" style="width: 40px; height: 40px; border-radius: 50%; background: #1b1b18; display: flex; align-items: center; justify-content: center; color: #d19e66; font-weight: 700; font-size: 16px; margin-right: 12px;">
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
				@endforeach
			</div>
			<!-- row -->
		</div>
		<!-- container-fluid End-->
	</section>
		@endif

	<!--=========================-->
	<!--=   Homepage Sections (after_reviews)   =-->
	<!--=========================-->

	@foreach(($homepageSections['after_reviews'] ?? []) as $section)
		@include('partials.homepage-section', ['section' => $section])
	@endforeach

	<!--=========================-->
	<!--=   Homepage Sections (before_footer)   =-->
	<!--=========================-->

	@foreach(($homepageSections['before_footer'] ?? []) as $section)
		@include('partials.homepage-section', ['section' => $section])
	@endforeach

@endsection

@push('styles')
<style>
/* Featured product card: cancel theme float so title/desc/price stack vertically */
.sin-product.style-one .mid-wrapper h5.pro-title {
    float: none;
    width: 100%;
    display: block;
    clear: both;
    text-align: center;
    margin-bottom: 6px;
}
.sin-product.style-one .mid-wrapper h5.pro-title a {
    white-space: normal;
    width: auto;
    overflow: visible;
    text-overflow: unset;
    display: block;
    text-align: center;
}
.sin-product.style-one .mid-wrapper p {
    float: none !important;
    display: block !important;
    width: 100% !important;
    clear: both;
    text-align: center !important;
}
.sin-product.style-one .mid-wrapper > ul {
    float: none;
    clear: both;
    display: block;
    width: 100%;
    margin: 0 0 6px;
    padding: 0;
    text-align: center;
}
.sin-product.style-one .mid-wrapper > ul > li {
    display: block !important;
    float: none !important;
    text-align: center;
}

/* ── Shop by Category ─────────────────────── */

.category-discovery-section {
    padding: 48px 0;
}
.category-tile {
    display: block;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-tile:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.14);
}
.category-tile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.category-tile-fallback {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 56px;
    font-weight: 800;
    color: #fff;
    background: linear-gradient(135deg, #d9b8a3 0%, #b25b30 100%);
}
.category-tile-name {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 14px 12px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0));
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    text-align: center;
}

/* ── Results / Timeline Carousel ─────────────────────── */

.promo-banners-section {
    overflow: clip;
    padding: 48px 0;
}

.promo-banner-section-header {
    text-align: center;
    margin-bottom: 28px;
    padding: 0 15px;
}
.promo-banner-section-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #b25b30;
    margin: 0 0 8px;
}
.promo-banner-section-subtitle {
    font-size: 13px;
    color: #888;
    margin: 0;
}

/* Aligns with .container-two (max-width: 1430px) used by the product grid */
.promo-banner-wrap {
    max-width: 1430px;
    margin: 0 auto;
    padding: 0 15px;
    overflow: clip;
}

/* Owl carousel item — content-driven height, no fixed px */
.prc-card {
    vertical-align: top;
}

/* Top label: "2–4 WEEKS" */
.prc-top-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #b25b30;
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Image / video container */
.prc-media {
    position: relative;
    width: 100%;
    height: 380px;
    overflow: hidden;
    border-radius: 8px;
    background: #1b1b18;
}

.prc-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.prc-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.prc-iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: 0;
}

/* Gradient overlay — anchored at bottom of image */
.prc-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 60px 16px 18px;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.80) 0%,
        rgba(0,0,0,0.50) 40%,
        transparent 100%
    );
    z-index: 10;
    pointer-events: none;
}
.prc-overlay > * { pointer-events: auto; }

.prc-overlay-title {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.2;
    margin: 0 0 5px;
}
.prc-overlay-desc {
    font-size: 12px;
    line-height: 1.4;
    margin: 0 0 10px;
}
.prc-overlay-btn {
    display: inline-block;
    background: #fff;
    color: #1b1b18 !important;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-decoration: none !important;
}
.prc-overlay-btn:hover { background: #f0f0f0; }

/* Below-image content */
.prc-bottom {
    padding: 10px 4px 4px;
}
.prc-bottom-title {
    font-size: 15px;
    font-weight: 700;
    color: #1b1b18;
    margin: 0 0 6px;
    line-height: 1.3;
}
.prc-bottom-desc {
    font-size: 13px;
    color: #666;
    line-height: 1.5;
    margin: 0 0 10px;
}
.prc-shop-link {
    font-size: 13px;
    font-weight: 600;
    color: #b25b30;
    text-decoration: none;
}
.prc-shop-link:hover { color: #8f3f1c; text-decoration: underline; }

/* Mobile — edge-to-edge, single-item swipe */
@media (max-width: 991px) {
    .promo-banners-section        { padding: 24px 0; }
    .promo-banner-wrap            { padding: 0; }
    .promo-banner-section-header  { margin-bottom: 20px; }
    .prc-media                    { height: 300px; border-radius: 0; }
    .prc-top-label                { padding: 0 12px; }
    .prc-bottom                   { padding: 10px 12px 4px; }
    .prc-bottom-title             { font-size: 14px; }
    .prc-overlay-title            { font-size: 15px; }
}

/* Owl dots */
.promo-banners-section .owl-dots            { margin-top: 14px; text-align: center; }
.promo-banners-section .owl-dot span        { background: #ccc !important; }
.promo-banners-section .owl-dot.active span { background: #b25b30 !important; }

/* Nav arrows — overlaid on the image portion only */
.promo-banners-section .owl-nav {
    position: absolute;
    top: 28px;
    left: 0;
    right: 0;
    height: 380px;
    pointer-events: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 8px;
}
.promo-banners-section .owl-nav.disabled { display: none; }
/* Owl 2.2.1 renders arrows as <div class="owl-prev/owl-next">, not <button>.
   Target the actual elements so pointer-events + styling apply. */
.promo-banners-section .owl-nav .owl-prev,
.promo-banners-section .owl-nav .owl-next {
    pointer-events: auto;
    cursor: pointer;
    background: rgba(0,0,0,0.45) !important;
    color: #fff !important;
    border-radius: 50% !important;
    width: 44px; height: 44px;
    display: flex; align-items: center; justify-content: center;
    font-size: 26px !important;
    line-height: 1 !important;
    z-index: 20;
    transition: background 0.2s;
    position: static;
    transform: none;
    margin: 0;
}
.promo-banners-section .owl-nav .owl-prev:hover,
.promo-banners-section .owl-nav .owl-next:hover { background: rgba(0,0,0,0.7) !important; }

/* ── Steps card layout (How To Use / Why Choose Us / Features) ─── */
.step-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    height: 100%;
}
.step-card-label {
    background: #1b1b18;
    color: #d19e66;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 8px 16px;
    text-align: center;
}
.step-card-media {
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
}
.step-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.step-card-body {
    padding: 18px 20px 22px;
    flex: 1;
}
.step-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #1b1b18;
    margin: 0 0 10px;
    line-height: 1.35;
}
.step-card-desc {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin: 0 0 8px;
}
.step-card-desc:last-child { margin-bottom: 0; }
@media (max-width: 767px) {
    .step-card-body { padding: 14px 16px 18px; }
    .step-card-title { font-size: 14px; }
    .step-card-desc  { font-size: 13px; }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    var MOBILE_MAX = 991; // tier breakpoint is 992; < 992 == mobile

    function initCarousel($el) {
        var desktopItems = parseInt($el.data('items')) || 3;
        var totalItems   = parseInt($el.data('total')) || desktopItems;
        var needsDesktopNav = totalItems > desktopItems;

        $el.owlCarousel({
            loop: false,
            rewind: true,
            margin: 16,
            navText: ['&#10094;', '&#10095;'],
            responsiveRefreshRate: 350,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: totalItems > 1 ? 40 : 0,
                    dots: totalItems > 1,
                    nav: false,
                    touchDrag: true,
                    mouseDrag: true
                },
                992: {
                    items: desktopItems,
                    stagePadding: 0,
                    dots: needsDesktopNav,
                    nav: needsDesktopNav,
                    touchDrag: needsDesktopNav,
                    mouseDrag: needsDesktopNav,
                    pullDrag: needsDesktopNav
                }
            }
        });
    }

    $('.promo-banner-carousel').each(function () { initCarousel($(this)); });

    // Responsive lifecycle.
    //
    // Owl 2.2.1's responsive transition is unreliable when a breakpoint is
    // crossed by a real manual window drag: its native onResize is throttled and
    // :visible-guarded, and a single matchMedia('change') listener fires only
    // ONCE per crossing (so a debounce that resolves mid-drag lays out for an
    // intermediate width and is never corrected). The observed symptom is
    // "swipe/dots don't activate" and "desktop layout not restored" until a
    // manual page refresh — i.e. a stale/partial tier with leftover Owl wrappers,
    // classes, padding, dots or drag bindings from the previous tier.
    //
    // Fix: drive the lifecycle off `window resize`, debounced so it only runs
    // once the user has actually stopped (final, settled width). On a TIER change
    // (mobile <-> desktop, where items/dots/nav/touchDrag all differ) we fully
    // destroy() — which removes every Owl wrapper, class and clone and restores
    // the original markup — then re-init from a clean slate against the fresh
    // viewport. No stale state is structurally possible. For a same-tier width
    // change we take the cheap path: invalidate('width') + refresh() so item
    // widths/coordinates track the final viewport (a bare refresh() skips the
    // width-filtered stagePadding/coordinate operators).
    var reflowTimer = null;
    var lastWidth = window.innerWidth;
    var lastMobile = window.innerWidth <= MOBILE_MAX;

    function reflowPromoCarousels() {
        var isMobile = window.innerWidth <= MOBILE_MAX;
        var tierChanged = isMobile !== lastMobile;
        lastMobile = isMobile;

        $('.promo-banner-carousel').each(function () {
            var $el = $(this);
            var owl = $el.data('owl.carousel');
            if (!owl) return;
            if (tierChanged) {
                owl.destroy();      // strip all Owl DOM/classes/clones, restore markup
                initCarousel($el);  // rebuild clean for the new tier
            } else {
                owl.invalidate('width');
                owl.refresh();
            }
        });
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth === lastWidth) return; // ignore height-only resizes
        lastWidth = window.innerWidth;
        clearTimeout(reflowTimer);
        reflowTimer = setTimeout(reflowPromoCarousels, 200);
    });
});
</script>
@endpush
