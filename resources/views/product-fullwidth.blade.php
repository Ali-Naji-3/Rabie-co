@extends('layouts.app')

@section('title', $product->name . ' - Softyskin')

@php
	// Build the gallery image list (primary first, then gallery images, then fallback).
	$pdpGallery = [];
	if ($product->primary_image) {
		$pdpGallery[] = asset('storage/' . $product->primary_image);
	}
	if (!empty($product->images)) {
		foreach ($product->images as $pdpImg) {
			$pdpGallery[] = asset('storage/' . $pdpImg);
		}
	}
	if (empty($pdpGallery)) {
		$pdpGallery[] = asset('media/images/product/single/b1.jpg');
	}
	$pdpMaxQty = $product->stock > 0 ? min(10, (int) $product->stock) : 1;
	$pdpIsNew  = $product->created_at && $product->created_at->gt(now()->subDays(30));
@endphp

@push('styles')
<style>
	.pdp {
		--bg: #FAF8F4;
		--white: #FFFFFF;
		--gold: #D4AF37;
		--ink: #111111;
		--muted: #666666;
		--border: #ECE8E1;
		--serif: 'Cormorant Garamond', serif;
		--sans: 'Inter', sans-serif;
		background: var(--bg);
		font-family: var(--sans);
		color: var(--ink);
		padding-bottom: 100px;
	}
	.pdp img { contain: layout style paint; }

	/* ---- Breadcrumb ---- */
	.pdp-breadcrumb {
		padding: 40px 0 0;
	}
	.pdp-breadcrumb p {
		margin: 0;
		font-size: 13px;
		letter-spacing: 0.6px;
		color: var(--muted);
		text-transform: uppercase;
	}
	.pdp-breadcrumb a { color: var(--muted); text-decoration: none; transition: color .2s ease; }
	.pdp-breadcrumb a:hover { color: var(--gold); }
	.pdp-breadcrumb .current { color: var(--gold); font-weight: 500; }

	/* ---- Detail row spacing (keeps gallery clear of the header) ---- */
	.pdp-detail-row { margin-top: 36px; }

	/* ---- Gallery ---- */
	.pdp-gallery { position: sticky; top: 40px; }
	.pdp-stage {
		position: relative;
		background: var(--white);
		border-radius: 16px;
		overflow: hidden;
		box-shadow: 0 24px 60px rgba(17,17,17,0.08);
		aspect-ratio: 1 / 1;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.pdp-stage img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
		transition: opacity .35s ease;
	}
	.pdp-badge-new {
		position: absolute;
		top: 18px;
		left: 18px;
		background: var(--ink);
		color: #fff;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: 1.5px;
		text-transform: uppercase;
		padding: 7px 14px;
		border-radius: 999px;
		z-index: 3;
	}
	.pdp-expand {
		position: absolute;
		top: 18px;
		right: 18px;
		width: 42px;
		height: 42px;
		border-radius: 50%;
		border: none;
		background: rgba(255,255,255,0.9);
		color: var(--ink);
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		box-shadow: 0 6px 16px rgba(17,17,17,0.1);
		transition: all .2s ease;
		z-index: 3;
	}
	.pdp-expand:hover { background: var(--gold); color: #fff; }
	.pdp-nav {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		width: 44px;
		height: 44px;
		border-radius: 50%;
		border: none;
		background: rgba(255,255,255,0.92);
		color: var(--ink);
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		box-shadow: 0 6px 18px rgba(17,17,17,0.12);
		transition: all .2s ease;
		z-index: 3;
	}
	.pdp-nav:hover { background: var(--gold); color: #fff; }
	.pdp-nav.prev { left: 16px; }
	.pdp-nav.next { right: 16px; }

	.pdp-thumbs {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 14px;
		margin-top: 16px;
	}
	.pdp-thumb {
		background: var(--white);
		border: 2px solid var(--border);
		border-radius: 12px;
		overflow: hidden;
		aspect-ratio: 1 / 1;
		cursor: pointer;
		padding: 0;
		transition: border-color .2s ease, transform .2s ease;
	}
	.pdp-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
	.pdp-thumb:hover { transform: translateY(-3px); border-color: rgba(212,175,55,0.5); }
	.pdp-thumb.active { border-color: var(--gold); }

	/* ---- Product info ---- */
	.pdp-info { padding-left: 22px; }
	.pdp-eyebrow {
		color: var(--gold);
		font-size: 12px;
		font-weight: 600;
		letter-spacing: 2.5px;
		text-transform: uppercase;
		margin-bottom: 12px;
	}
	.pdp-title {
		font-family: var(--serif);
		font-size: 46px;
		line-height: 1.08;
		font-weight: 600;
		color: var(--ink);
		margin: 0 0 16px;
	}
	.pdp-rating-row {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 22px;
	}
	.pdp-stars { display: inline-flex; gap: 2px; font-size: 15px; }
	.pdp-stars .fa-star, .pdp-stars .fa-star-half-alt { color: var(--gold); }
	.pdp-stars .empty { color: #dcd6ca; }
	.pdp-rating-num { font-weight: 600; font-size: 15px; color: var(--ink); }
	.pdp-rating-count { color: var(--muted); font-size: 14px; }

	.pdp-price-block { margin-bottom: 22px; }
	.pdp-price-line { display: flex; align-items: baseline; gap: 12px; }
	.pdp-price-label { color: var(--muted); font-size: 14px; min-width: 110px; }
	.pdp-price-old {
		color: #9CA3AF;
		font-size: 19px;
		text-decoration: line-through;
		text-decoration-thickness: 1px;
	}
	.pdp-price-final {
		color: var(--gold);
		font-size: 34px;
		font-weight: 700;
		letter-spacing: 0.5px;
	}
	.pdp-discount-badge {
		display: inline-block;
		background: rgba(212,175,55,0.12);
		color: var(--gold);
		font-size: 12px;
		font-weight: 600;
		padding: 3px 10px;
		border-radius: 999px;
		margin-left: 4px;
	}

	.pdp-desc {
		color: var(--muted);
		font-size: 15px;
		line-height: 1.75;
		margin-bottom: 26px;
	}
	.pdp-desc p:last-child { margin-bottom: 0; }

	.pdp-meta {
		display: flex;
		flex-wrap: wrap;
		gap: 40px;
		padding: 22px 0;
		border-top: 1px solid var(--border);
		border-bottom: 1px solid var(--border);
		margin-bottom: 28px;
	}
	.pdp-meta-label { color: var(--ink); font-weight: 600; font-size: 14px; }
	.pdp-meta-value { color: var(--muted); font-size: 14px; }

	/* ---- Quantity + actions ---- */
	.pdp-qty-label { display: block; color: var(--ink); font-weight: 500; font-size: 14px; margin-bottom: 10px; }
	.pdp-actions { display: flex; align-items: stretch; gap: 14px; flex-wrap: wrap; }
	.pdp-stepper {
		display: inline-flex;
		align-items: center;
		border: 1px solid var(--border);
		border-radius: 10px;
		background: var(--white);
		overflow: hidden;
		height: 60px;
	}
	.pdp-stepper button {
		width: 48px;
		height: 100%;
		border: none;
		background: transparent;
		color: var(--ink);
		font-size: 20px;
		cursor: pointer;
		transition: background .15s ease, color .15s ease;
	}
	.pdp-stepper button:hover { background: var(--bg); color: var(--gold); }
	.pdp-stepper input {
		width: 54px;
		height: 100%;
		text-align: center;
		border: none;
		background: transparent;
		font-size: 16px;
		font-weight: 600;
		color: var(--ink);
		-moz-appearance: textfield;
	}
	.pdp-stepper input::-webkit-outer-spin-button,
	.pdp-stepper input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

	.pdp-add-cart {
		flex: 1;
		min-width: 220px;
		height: 60px;
		background: var(--ink);
		color: #fff;
		border: none;
		border-radius: 10px;
		font-size: 14px;
		font-weight: 600;
		letter-spacing: 1.5px;
		text-transform: uppercase;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		transition: background .25s ease, transform .15s ease, box-shadow .25s ease;
	}
	.pdp-add-cart:hover {
		background: #000;
		transform: translateY(-2px);
		box-shadow: 0 14px 30px rgba(17,17,17,0.22);
	}
	/* ---- Trust badges ---- */
	.pdp-trust {
		display: flex;
		flex-wrap: wrap;
		gap: 18px;
		margin-top: 32px;
		padding-top: 28px;
		border-top: 1px solid var(--border);
	}
	.pdp-trust-item { flex: 1; min-width: 150px; display: flex; gap: 12px; align-items: flex-start; }
	.pdp-trust-icon {
		width: 40px; height: 40px;
		flex-shrink: 0;
		border-radius: 50%;
		background: rgba(212,175,55,0.12);
		color: var(--gold);
		display: flex; align-items: center; justify-content: center;
		font-size: 16px;
	}
	.pdp-trust-title { font-size: 14px; font-weight: 600; color: var(--ink); margin-bottom: 2px; }
	.pdp-trust-sub { font-size: 12.5px; color: var(--muted); line-height: 1.4; }

	/* ---- Section wrapper ---- */
	.pdp-section { margin-top: 70px; }
	.pdp-card-surface {
		background: var(--white);
		border: 1px solid var(--border);
		border-radius: 18px;
		box-shadow: 0 18px 50px rgba(17,17,17,0.05);
		padding: 40px;
	}
	.pdp-section-head {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 16px;
		margin-bottom: 30px;
		flex-wrap: wrap;
	}
	.pdp-section-title {
		font-family: var(--serif);
		font-size: 32px;
		font-weight: 600;
		color: var(--ink);
		margin: 0;
	}
	.pdp-btn-outline {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		background: transparent;
		color: var(--ink);
		border: 1.5px solid var(--gold);
		border-radius: 10px;
		padding: 12px 26px;
		font-size: 13px;
		font-weight: 600;
		letter-spacing: 1px;
		text-transform: uppercase;
		text-decoration: none;
		transition: all .25s ease;
	}
	.pdp-btn-outline:hover { background: var(--gold); color: #fff; }

	/* ---- Review cards ---- */
	.pdp-review {
		background: var(--bg);
		border: 1px solid var(--border);
		border-radius: 14px;
		padding: 24px 26px;
		margin-bottom: 18px;
	}
	.pdp-review:last-child { margin-bottom: 0; }
	.pdp-review-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 14px; }
	.pdp-review-user { display: flex; align-items: center; gap: 14px; }
	.pdp-avatar {
		width: 48px; height: 48px;
		border-radius: 50%;
		background: rgba(212,175,55,0.14);
		color: var(--gold);
		display: flex; align-items: center; justify-content: center;
		font-family: var(--serif);
		font-size: 20px;
		font-weight: 600;
		flex-shrink: 0;
	}
	.pdp-review-name { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
	.pdp-review-name strong { font-size: 15px; color: var(--ink); }
	.pdp-verified {
		display: inline-flex; align-items: center; gap: 5px;
		font-size: 11px; font-weight: 600;
		color: var(--gold);
		border: 1px solid var(--gold);
		border-radius: 999px;
		padding: 3px 10px;
		text-transform: capitalize;
	}
	.pdp-review-stars { margin-top: 6px; display: inline-flex; align-items: center; gap: 3px; font-size: 13px; }
	.pdp-review-stars .fa-star { color: var(--gold); }
	.pdp-review-stars .empty { color: #dcd6ca; }
	.pdp-review-stars .rate-num { margin-left: 6px; color: var(--muted); font-size: 13px; }
	.pdp-review-date { color: var(--muted); font-size: 12.5px; white-space: nowrap; }
	.pdp-review-title { font-size: 15px; font-weight: 600; color: var(--ink); margin: 16px 0 6px; }
	.pdp-review-body { color: var(--muted); font-size: 14.5px; line-height: 1.7; margin: 0; }
	.pdp-reviews-foot { margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); text-align: center; }
	.pdp-reviews-foot a, .pdp-reviews-foot span { color: var(--gold); font-size: 14px; font-weight: 600; text-decoration: none; }
	.pdp-empty { text-align: center; padding: 50px 0; color: var(--muted); }
	.pdp-empty i { font-size: 40px; color: var(--border); margin-bottom: 14px; }

	/* ---- Related products ---- */
	.pdp-related-grid {
		display: grid;
		grid-template-columns: repeat(5, 1fr);
		gap: 22px;
	}
	.pdp-rel-card {
		background: var(--white);
		border: 1px solid var(--border);
		border-radius: 16px;
		overflow: hidden;
		transition: transform .25s ease, box-shadow .25s ease;
		display: flex;
		flex-direction: column;
	}
	.pdp-rel-card:hover { transform: translateY(-6px); box-shadow: 0 22px 50px rgba(17,17,17,0.1); }
	.pdp-rel-img { display: block; aspect-ratio: 1 / 1; background: var(--bg); overflow: hidden; }
	.pdp-rel-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
	.pdp-rel-card:hover .pdp-rel-img img { transform: scale(1.05); }
	.pdp-rel-body { padding: 18px 18px 22px; display: flex; flex-direction: column; gap: 8px; }
	.pdp-rel-title { font-size: 14.5px; font-weight: 600; color: var(--ink); margin: 0; line-height: 1.35; }
	.pdp-rel-title a { color: inherit; text-decoration: none; transition: color .2s ease; }
	.pdp-rel-title a:hover { color: var(--gold); }
	.pdp-rel-price { display: flex; align-items: baseline; gap: 8px; }
	.pdp-rel-price .final { color: var(--ink); font-size: 16px; font-weight: 700; }
	.pdp-rel-price .old { color: #9CA3AF; font-size: 13px; text-decoration: line-through; }
	.pdp-rel-stars { font-size: 12px; display: inline-flex; gap: 2px; }
	.pdp-rel-stars .fa-star { color: var(--gold); }
	.pdp-rel-stars .empty { color: #dcd6ca; }

	/* ---- Responsive ---- */
	@media (max-width: 1199px) {
		.pdp-related-grid { grid-template-columns: repeat(3, 1fr); }
	}
	@media (max-width: 991px) {
		.pdp-info { padding-left: 0; margin-top: 36px; }
		.pdp-gallery { position: static; }
		.pdp-title { font-size: 38px; }
		.pdp-related-grid { grid-template-columns: repeat(2, 1fr); }
		.pdp-card-surface { padding: 28px; }
	}
	@media (max-width: 575px) {
		.pdp-title { font-size: 30px; }
		.pdp-price-final { font-size: 28px; }
		.pdp-add-cart { min-width: 0; }
		.pdp-related-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
		.pdp-meta { gap: 24px; }
		.pdp-section-title { font-size: 26px; }
	}
</style>
@endpush

@section('content')
<div class="pdp">
	<div class="container">

		<!-- Breadcrumb -->
		<div class="pdp-breadcrumb">
			<p>
				<a href="{{ route('home') }}">Home</a> &nbsp;/&nbsp;
				<a href="{{ route('collection') }}">Shop</a> &nbsp;/&nbsp;
				<span class="current">{{ $product->name }}</span>
			</p>
		</div>

		<!-- Product details -->
		<div class="row pdp-detail-row">
			<!-- Gallery -->
			<div class="col-lg-6">
				<div class="pdp-gallery">
					<div class="pdp-stage">
						@if($pdpIsNew)
							<span class="pdp-badge-new">New</span>
						@endif
						<button type="button" class="pdp-expand" id="pdpExpand" aria-label="View full image">
							<i class="fas fa-expand"></i>
						</button>
						@if(count($pdpGallery) > 1)
							<button type="button" class="pdp-nav prev" id="pdpPrev" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
							<button type="button" class="pdp-nav next" id="pdpNext" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
						@endif
						<img id="pdpMainImg" src="{{ $pdpGallery[0] }}" alt="{{ $product->name }}" loading="eager" decoding="async">
					</div>

					@if(count($pdpGallery) > 1)
						<div class="pdp-thumbs">
							@foreach($pdpGallery as $i => $imgUrl)
								<button type="button" class="pdp-thumb {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" data-src="{{ $imgUrl }}">
									<img src="{{ $imgUrl }}" alt="{{ $product->name }} thumbnail {{ $i + 1 }}" loading="lazy" decoding="async">
								</button>
							@endforeach
						</div>
					@endif
				</div>
			</div>

			<!-- Info -->
			<div class="col-lg-6">
				<div class="pdp-info">
					@if($product->category)
						<div class="pdp-eyebrow">{{ $product->category->name }}</div>
					@endif

					<h1 class="pdp-title">{{ $product->name }}</h1>

					@if($product->display_rating !== null)
						@php
							$pr = (float) $product->display_rating;
							$prFull = (int) floor($pr);
							$prHalf = ($pr - $prFull) >= 0.5;
						@endphp
						<div class="pdp-rating-row" style="cursor:pointer;" onclick="document.getElementById('reviews-section').scrollIntoView({behavior:'smooth'});">
							<span class="pdp-stars">
								@for($i = 1; $i <= 5; $i++)
									@if($i <= $prFull)
										<i class="fas fa-star"></i>
									@elseif($i === $prFull + 1 && $prHalf)
										<i class="fas fa-star-half-alt"></i>
									@else
										<i class="fas fa-star empty"></i>
									@endif
								@endfor
							</span>
							<span class="pdp-rating-num">{{ number_format($pr, 1) }}</span>
							<span class="pdp-rating-count">({{ number_format($product->display_review_count) }} Reviews)</span>
						</div>
					@endif

					<!-- Price -->
					<div class="pdp-price-block">
						@if($product->final_price < $product->price)
							<div class="pdp-price-line">
								<span class="pdp-price-label">Original Price</span>
								<span class="pdp-price-old">@price($product->price)</span>
								@if($product->discount_percentage > 0)
									<span class="pdp-discount-badge">{{ $product->discount_percentage }}% OFF</span>
								@endif
							</div>
							<div class="pdp-price-line" style="margin-top:6px;">
								<span class="pdp-price-label">Final Price</span>
								<span class="pdp-price-final">@price($product->final_price)</span>
							</div>
						@else
							<div class="pdp-price-line">
								<span class="pdp-price-label">Price</span>
								<span class="pdp-price-final">@price($product->final_price)</span>
							</div>
						@endif
					</div>

					<!-- Description -->
					<div class="pdp-desc">
						{!! $product->description !!}
					</div>

					<!-- Category & SKU -->
					<div class="pdp-meta">
						<div>
							<span class="pdp-meta-label">Category:</span>
							<span class="pdp-meta-value">{{ $product->category->name ?? '—' }}</span>
						</div>
						@if($product->sku)
							<div>
								<span class="pdp-meta-label">SKU:</span>
								<span class="pdp-meta-value">{{ $product->sku }}</span>
							</div>
						@endif
					</div>

					<!-- Add to cart -->
					<form method="POST" action="{{ route('cart.add') }}">
						@csrf
						<input type="hidden" name="product_id" value="{{ $product->id }}">

						<span class="pdp-qty-label">Quantity:</span>
						<div class="pdp-actions">
							<div class="pdp-stepper">
								<button type="button" id="pdpQtyMinus" aria-label="Decrease quantity">&minus;</button>
								<input type="number" name="quantity" id="pdpQty" value="1" min="1" max="{{ $pdpMaxQty }}">
								<button type="button" id="pdpQtyPlus" aria-label="Increase quantity">+</button>
							</div>

							<button type="submit" class="pdp-add-cart">
								<i class="fas fa-shopping-bag"></i> Add to Cart
							</button>
						</div>
					</form>

					<!-- Trust badges -->
					<div class="pdp-trust">
						<div class="pdp-trust-item">
							<div class="pdp-trust-icon"><i class="fas fa-award"></i></div>
							<div>
								<div class="pdp-trust-title">Trusted by Professionals</div>
								<div class="pdp-trust-sub">Dermatologist recommended</div>
							</div>
						</div>
						<div class="pdp-trust-item">
							<div class="pdp-trust-icon"><i class="fas fa-shield-alt"></i></div>
							<div>
								<div class="pdp-trust-title">Safe &amp; Gentle</div>
								<div class="pdp-trust-sub">Suitable for all skin types</div>
							</div>
						</div>
						<div class="pdp-trust-item">
							<div class="pdp-trust-icon"><i class="fas fa-certificate"></i></div>
							<div>
								<div class="pdp-trust-title">1-Year Warranty</div>
								<div class="pdp-trust-sub">Peace of mind guaranteed</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Customer Reviews -->
		<div class="pdp-section" id="reviews-section">
			<div class="pdp-card-surface">
				<div class="pdp-section-head">
					<h2 class="pdp-section-title">Customer Reviews</h2>
					@auth
						<a href="{{ route('review.create', $product->id) }}" class="pdp-btn-outline">
							<i class="fas fa-pen"></i> Write a Review
						</a>
					@else
						<a href="{{ route('login') }}" class="pdp-btn-outline">
							<i class="fas fa-sign-in-alt"></i> Login to Review
						</a>
					@endauth
				</div>

				@forelse($product->reviews as $review)
					<div class="pdp-review">
						<div class="pdp-review-top">
							<div class="pdp-review-user">
								<div class="pdp-avatar">{{ strtoupper(mb_substr($review->user->name ?? '?', 0, 1)) }}</div>
								<div>
									<div class="pdp-review-name">
										<strong>{{ $review->user->name }}</strong>
										<span class="pdp-verified"><i class="fas fa-check-circle"></i> Verified Purchase</span>
									</div>
									<div class="pdp-review-stars">
										@for($i = 1; $i <= 5; $i++)
											<i class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star empty' }}"></i>
										@endfor
										<span class="rate-num">{{ $review->rating }}/5</span>
									</div>
								</div>
							</div>
							<span class="pdp-review-date">{{ $review->created_at->format('M d, Y') }}</span>
						</div>
						@if($review->title)
							<div class="pdp-review-title">{{ $review->title }}</div>
						@endif
						<p class="pdp-review-body">{{ $review->comment }}</p>
					</div>
				@empty
					<div class="pdp-empty">
						<div><i class="far fa-comments"></i></div>
						<h5 style="color:#111;font-weight:600;">No reviews yet</h5>
						<p>Be the first to review this product.</p>
					</div>
				@endforelse

				@if($product->display_review_count && $product->reviews->count() < $product->display_review_count)
					<div class="pdp-reviews-foot">
						<span>Showing top {{ $product->reviews->count() }} of {{ number_format($product->display_review_count) }} reviews</span>
					</div>
				@endif
			</div>
		</div>

		<!-- Related Products -->
		@if($relatedProducts->count() > 0)
			<div class="pdp-section">
				<div class="pdp-section-head">
					<h2 class="pdp-section-title">Related Products</h2>
					<a href="{{ route('collection') }}" class="pdp-btn-outline">View All <i class="fas fa-arrow-right"></i></a>
				</div>
				<div class="pdp-related-grid">
					@foreach($relatedProducts as $related)
						<div class="pdp-rel-card">
							<a href="{{ route('product.show', $related->slug) }}" class="pdp-rel-img">
								<img src="{{ $related->primary_image ? asset('storage/' . $related->primary_image) : asset('media/images/product/sp1.jpg') }}"
									alt="{{ $related->name }}" loading="lazy" decoding="async">
							</a>
							<div class="pdp-rel-body">
								<h3 class="pdp-rel-title">
									<a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a>
								</h3>
								<div class="pdp-rel-price">
									<span class="final">@price($related->final_price)</span>
									@if($related->final_price < $related->price)
										<span class="old">@price($related->price)</span>
									@endif
								</div>
								@if($related->display_rating !== null)
									<span class="pdp-rel-stars">
										@for($i = 1; $i <= 5; $i++)
											<i class="{{ $i <= round($related->display_rating) ? 'fas fa-star' : 'far fa-star empty' }}"></i>
										@endfor
									</span>
								@endif
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif

	</div>
</div>
@endsection

@push('scripts')
<script>
(function () {
	// ---- Gallery ----
	var mainImg = document.getElementById('pdpMainImg');
	var thumbs  = Array.prototype.slice.call(document.querySelectorAll('.pdp-thumb'));
	var current = 0;

	function show(index) {
		if (!thumbs.length) return;
		current = (index + thumbs.length) % thumbs.length;
		var src = thumbs[current].getAttribute('data-src');
		mainImg.style.opacity = '0';
		setTimeout(function () {
			mainImg.src = src;
			mainImg.style.opacity = '1';
		}, 150);
		thumbs.forEach(function (t, i) { t.classList.toggle('active', i === current); });
	}

	thumbs.forEach(function (t, i) {
		t.addEventListener('click', function () { show(i); });
	});

	var prev = document.getElementById('pdpPrev');
	var next = document.getElementById('pdpNext');
	if (prev) prev.addEventListener('click', function () { show(current - 1); });
	if (next) next.addEventListener('click', function () { show(current + 1); });

	var expand = document.getElementById('pdpExpand');
	if (expand) expand.addEventListener('click', function () {
		if (mainImg && mainImg.src) window.open(mainImg.src, '_blank');
	});

	// ---- Quantity stepper ----
	var qty   = document.getElementById('pdpQty');
	var minus = document.getElementById('pdpQtyMinus');
	var plus  = document.getElementById('pdpQtyPlus');

	function clampQty(v) {
		var min = parseInt(qty.getAttribute('min'), 10) || 1;
		var max = parseInt(qty.getAttribute('max'), 10) || 99;
		if (isNaN(v) || v < min) v = min;
		if (v > max) v = max;
		return v;
	}
	if (minus) minus.addEventListener('click', function () { qty.value = clampQty(parseInt(qty.value, 10) - 1); });
	if (plus)  plus.addEventListener('click', function () { qty.value = clampQty(parseInt(qty.value, 10) + 1); });
	if (qty)   qty.addEventListener('change', function () { qty.value = clampQty(parseInt(qty.value, 10)); });

})();
</script>
@endpush
