@if($customerReviewSettings->is_active)
@php
    $crStats = $customerReviewStats;
    $crTotal = (int) ($crStats['total'] ?? 0);
    $crAverage = (float) ($crStats['average'] ?? 0);
    $crStarCounts = $crStats['star_counts'] ?? [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
    $crAvgRounded = (int) round($crAverage);
    // Photos gallery is sourced from approved reviews that have an image.
    $crPhotos = $customerReviews->filter(fn ($r) => ! empty($r->image))->values();
@endphp
<section class="reveal customer-reviews-section luxe-bg" id="customer-reviews">
    <div class="container custom-container">
        <!-- Section Header -->
        <div class="reveal reviews-header text-center mb-5">
            <h2 class="reviews-section-title">{{ $customerReviewSettings->section_title }}</h2>
        </div>

        @if(session('success'))
            <div class="cr-flash cr-flash-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="cr-flash cr-flash-error">
                <ul class="mb-0 pl-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Block 1: Review Summary -->
        <div class="reveal review-summary-card">
            <div class="row align-items-center">
                <!-- Left: Overall Rating -->
                <div class="col-lg-3 col-md-4 text-center border-divider-right">
                    <div class="overall-rating">
                        <div class="stars-gold mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $crAvgRounded ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                        <h3 class="rating-number">{{ number_format($crAverage, 2) }} <span>out of 5</span></h3>
                        <p class="review-count">Based on {{ number_format($crTotal) }} reviews</p>
                    </div>
                </div>

                <!-- Center: Distribution -->
                <div class="col-lg-6 col-md-8 px-lg-5">
                    <div class="rating-distribution">
                        @foreach([5, 4, 3, 2, 1] as $star)
                            @php $count = (int) ($crStarCounts[$star] ?? 0); @endphp
                            <div class="distribution-row">
                                <span class="dist-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $star)
                                            <i class="fas fa-star filled-star"></i>
                                        @else
                                            <i class="far fa-star empty-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <div class="dist-bar-bg">
                                    <div class="dist-bar-fill" style="width: {{ $crTotal > 0 ? ($count / $crTotal) * 100 : 0 }}%"></div>
                                </div>
                                <span class="dist-count">{{ number_format($count) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right: Action -->
                <div class="col-lg-3 col-md-12 text-center mt-4 mt-lg-0">
                    <button class="btn-luxe-dark open-create-review">Create a Review</button>
                </div>
            </div>
        </div>

        <!-- Block 2: Customer Photos -->
        @if($crPhotos->isNotEmpty())
        <div class="reveal photos-gallery-section mt-5">
            <h4 class="gallery-title mb-3">Customer Photos</h4>
            <div class="gallery-wrapper">
                <div class="gallery-scroll">
                    @foreach($crPhotos->take(8) as $photo)
                        <div class="gallery-item open-photo-details" data-photo="{{ asset('storage/'.$photo->image) }}">
                            <img src="{{ asset('storage/'.$photo->image) }}" alt="Customer Photo" loading="lazy">
                        </div>
                    @endforeach
                    @if($crPhotos->count() > 8)
                        <div class="gallery-item see-more">
                            <span>See more</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Block 3: Reviews Feed -->
        <div class="reviews-feed mt-5">
            <div class="feed-controls d-flex justify-content-between align-items-center flex-wrap mb-4">
                <!-- Star filters (client-side, no requests) -->
                <div class="review-filters" id="reviewFilters">
                    <button type="button" class="filter-pill active" data-filter="all">All Reviews</button>
                    @foreach([5, 4, 3, 2, 1] as $star)
                        <button type="button" class="filter-pill" data-filter="{{ $star }}">{{ $star }} <i class="fas fa-star"></i></button>
                    @endforeach
                </div>
            </div>

            <!-- Reviews -->
            <div class="review-list" id="reviewList">
                @forelse($customerReviews as $review)
                    <div class="reveal review-card-item" data-rating="{{ $review->rating }}">
                        @if($review->is_pinned)
                            <div class="pin-icon"><i class="fas fa-thumbtack"></i></div>
                        @endif

                        <div class="review-card-header d-flex align-items-center">
                            <div class="customer-avatar">
                                {{ strtoupper(substr($review->customer_name, 0, 1)) }}
                            </div>
                            <div class="customer-meta">
                                <h6 class="customer-name mb-0">{{ $review->customer_name }} <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span></h6>
                                <div class="stars-gold-small">
                                    @for($i = 0; $i < $review->rating; $i++) <i class="fas fa-star"></i> @endfor
                                </div>
                            </div>
                        </div>

                        <div class="review-card-body d-flex mt-3">
                            <div class="review-content flex-grow-1">
                                <h5 class="review-item-title">{{ $review->title }}</h5>
                                <p class="review-item-text">{{ $review->description }}</p>
                            </div>
                            @if($review->image)
                                <div class="review-item-thumb open-photo-details" data-photo="{{ asset('storage/'.$review->image) }}">
                                    <img src="{{ asset('storage/'.$review->image) }}" alt="Review Image" loading="lazy">
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="review-empty text-center">Be the first to leave a review.</p>
                @endforelse
                <p class="review-empty review-no-matches text-center" style="display:none;">No reviews match this rating yet.</p>
            </div>
        </div>

        <!-- Block 4: Bottom CTA -->
        <div class="reveal reviews-bottom-cta text-center mt-5">
            <button class="btn-luxe-dark btn-lg px-5 open-create-review">Create a Review</button>
        </div>
    </div>
</section>
@endif

<!-- Create Review Modal -->
<div class="luxe-modal" id="createReviewModal">
    <div class="modal-dialog-luxe">
        <div class="modal-header-luxe">
            <button type="button" class="close-modal"><i class="fas fa-arrow-left"></i></button>
            <h4 class="modal-title">Create a Review</h4>
        </div>
        <form class="modal-body-luxe" method="POST" action="{{ route('customer-review.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Honeypot: hidden from users; bots that fill it are silently dropped. -->
            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true">

            <div class="form-group mb-3">
                <label>Your name</label>
                <input type="text" name="customer_name" class="luxe-input" placeholder="Enter your name" value="{{ old('customer_name') }}" maxlength="255" required>
            </div>
            <div class="form-group mb-3">
                <label>Title of review</label>
                <input type="text" name="title" class="luxe-input" placeholder="Give your review a title" value="{{ old('title') }}" maxlength="255" required>
            </div>
            <div class="form-group mb-3">
                <label>Description of review</label>
                <textarea name="description" class="luxe-input" rows="4" placeholder="Write your review here..." maxlength="2000" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label>Upload image (optional)</label>
                <label class="upload-placeholder" for="reviewImageInput">
                    <i class="fas fa-camera fa-2x mb-2"></i>
                    <p class="upload-text">Click to upload image</p>
                </label>
                <input type="file" name="image" id="reviewImageInput" accept="image/jpeg,image/png,image/webp" class="d-none">
            </div>
            <div class="form-group mb-4">
                <label>Rating</label>
                <div class="star-rating-input">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <input type="hidden" name="rating" id="reviewRatingInput" value="{{ old('rating') }}" required>
            </div>
            <button type="submit" class="btn-luxe-dark w-100">Submit Review</button>
        </form>
    </div>
</div>

<!-- Photo Details Modal (Frontend Prototype) -->
<div class="luxe-modal" id="photoDetailsModal">
    <div class="modal-dialog-large">
        <button class="close-modal-float"><i class="fas fa-times"></i></button>
        <div class="details-layout d-flex flex-column flex-lg-row">
            <div class="details-media-panel">
                <img id="modalLargeImage" src="" alt="Customer Photo">
                <div class="media-thumbnails d-flex mt-3">
                    <img src="https://picsum.photos/100/100?random=1" class="active">
                    <img src="https://picsum.photos/100/100?random=2">
                    <img src="https://picsum.photos/100/100?random=3">
                    <div class="thumb-more">See more</div>
                </div>
            </div>
            <div class="details-info-panel p-4">
                <div class="customer-info-header d-flex align-items-center mb-3">
                    <div class="stars-gold-small mr-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <h5 class="mb-0 mr-3">Jasmine H.</h5>
                    <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                </div>
                <h4 class="mb-3">JUST RESULTS!!!</h4>
                <p class="text-muted">THE PROCESS! It really works. I did my full 12 weeks on my MOST important parts (under arms, lower legs, bikini). It literally changed my life! I highly recommend it to anyone looking for a permanent solution.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* --- Customer Reviews Luxe Styling --- */
.customer-reviews-section { padding: 80px 0; background: #fff; }
.reviews-section-title { font-size: 32px; font-weight: 700; color: #111; font-family: 'Poppins', sans-serif; }

/* Summary Card */
.review-summary-card { 
    background: #fff; 
    border-radius: 16px; 
    padding: 40px; 
    border: 1px solid #eaeaea; 
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}
.stars-gold { color: #D4AF37; font-size: 20px; }
.stars-gold-small { color: #D4AF37; font-size: 14px; }
.rating-number { font-size: 36px; font-weight: 700; color: #111; margin: 0; }
.rating-number span { font-size: 16px; color: #888; font-weight: 400; }
.review-count { color: #666; font-size: 14px; margin-top: 5px; }

.border-divider-right { border-right: 1px solid #f0f0f0; }

/* Distribution Bars */
.distribution-row { display: flex; align-items: center; margin-bottom: 8px; }
.dist-stars { width: 100px; display: flex; gap: 2px; font-size: 11px; }
.filled-star { color: #D4AF37; }
.empty-star { color: #E5E7EB; }
.dist-bar-bg { flex: 1; height: 8px; background: #f0f0f0; border-radius: 4px; margin: 0 15px; overflow: hidden; }
.dist-bar-fill { height: 100%; background: #D4AF37; border-radius: 4px; }
.dist-count { width: 40px; font-size: 13px; color: #888; text-align: right; }

/* Customer Photos Gallery */
.gallery-wrapper { position: relative; margin: 0 -15px; }
.gallery-scroll { 
    display: flex; 
    overflow-x: auto; 
    padding: 10px 15px; 
    gap: 15px; 
    scrollbar-width: none; 
}
.gallery-scroll::-webkit-scrollbar { display: none; }
.gallery-item { 
    min-width: 120px; 
    height: 120px; 
    border-radius: 8px; 
    overflow: hidden; 
    cursor: pointer; 
    position: relative;
    border: 1px solid #f0f0f0;
}
.gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
.gallery-item:hover img { transform: scale(1.05); }

.gallery-item.see-more { 
    background: #fdfdfd; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    border: 2px dashed #eaeaea; 
}
.gallery-item.see-more span { font-size: 13px; font-weight: 600; color: #888; text-transform: uppercase; }

/* Reviews Feed */
.review-card-item { 
    background: #fff; 
    border-bottom: 1px solid #f5f5f5; 
    padding: 30px 0; 
    position: relative;
}
.review-card-item:last-child { border-bottom: none; }
.pin-icon { position: absolute; right: 0; top: 30px; color: #D4AF37; font-size: 16px; }

.customer-avatar { 
    width: 44px; height: 44px; border-radius: 50%; background: #111; color: #D4AF37; 
    display: flex; align-items: center; justify-content: center; font-weight: 700; margin-right: 15px;
}
.customer-name { font-weight: 700; color: #111; display: flex; align-items: center; }
.verified-badge { 
    background: rgba(212, 175, 55, 0.1); color: #D4AF37; font-size: 10px; 
    font-weight: 700; padding: 2px 8px; border-radius: 12px; margin-left: 10px; text-transform: uppercase;
}

.review-item-title { font-size: 18px; font-weight: 700; color: #111; margin-bottom: 8px; }
.review-item-text { font-size: 15px; line-height: 1.6; color: #555; }
.review-item-thumb { width: 100px; height: 100px; border-radius: 8px; overflow: hidden; margin-left: 20px; flex-shrink: 0; cursor: pointer; }
.review-item-thumb img { width: 100%; height: 100%; object-fit: cover; }

/* Buttons & Inputs */
.btn-luxe-dark { 
    background: #111; color: #D4AF37 !important; border: none; padding: 12px 30px; 
    border-radius: 8px; font-weight: 700; transition: all 0.3s; pointer-events: auto;
}
.btn-luxe-dark:hover { background: #000; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

.luxe-select { 
    border: 1px solid #eaeaea; background: #fff; padding: 8px 15px; border-radius: 6px; 
    font-size: 14px; outline: none; cursor: pointer; 
}
.luxe-input { 
    width: 100%; border: 1px solid #eaeaea; padding: 12px 15px; border-radius: 8px; outline: none; transition: border 0.3s;
}
.luxe-input:focus { border-color: #D4AF37; }

/* Modals */
.luxe-modal { 
    position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); 
    z-index: 10000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(4px);
    padding: 20px;
}
.luxe-modal.active { display: flex; }

.modal-dialog-luxe { background: #fff; width: 100%; max-width: 500px; border-radius: 16px; overflow: hidden; animation: slideUp 0.3s; }
.modal-header-luxe { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; position: relative; }
.modal-title { margin: 0; font-size: 18px; font-weight: 700; color: #111; flex-grow: 1; text-align: center; }
.close-modal { background: none; border: none; font-size: 18px; color: #888; cursor: pointer; position: absolute; left: 20px; top: 50%; transform: translateY(-50%); }

.modal-body-luxe { padding: 25px; }
.upload-placeholder { 
    background: #f9f9f9; border: 2px dashed #eaeaea; border-radius: 12px; padding: 30px; 
    text-align: center; color: #888; cursor: pointer; transition: background 0.3s;
}
.upload-placeholder:hover { background: #f0f0f0; }
.star-rating-input { color: #ddd; font-size: 24px; gap: 5px; display: flex; cursor: pointer; }
.star-rating-input i:hover, .star-rating-input i.active { color: #D4AF37; }

/* Large Photo Modal */
.modal-dialog-large { background: #fff; width: 100%; max-width: 900px; border-radius: 16px; overflow: hidden; position: relative; }
.close-modal-float { position: absolute; right: 20px; top: 20px; width: 36px; height: 36px; border-radius: 50%; background: #fff; border: none; color: #111; z-index: 10; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

.details-media-panel { flex: 1.2; background: #000; display: flex; flex-direction: column; }
.details-media-panel img#modalLargeImage { width: 100%; height: 500px; object-fit: cover; }
.media-thumbnails { padding: 15px; gap: 10px; background: #fff; }
.media-thumbnails img { width: 60px; height: 60px; border-radius: 6px; object-fit: cover; cursor: pointer; opacity: 0.6; }
.media-thumbnails img.active { opacity: 1; border: 2px solid #D4AF37; }
.thumb-more { width: 60px; height: 60px; border-radius: 6px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: #888; text-align: center; }

.details-info-panel { flex: 1; background: #fff; overflow-y: auto; max-height: 600px; }

@keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

/* Mobile Adaptations */
@media (max-width: 991px) {
    .review-summary-card { padding: 25px; }
    .border-divider-right { border-right: none; border-bottom: 1px solid #f0f0f0; padding-bottom: 25px; margin-bottom: 25px; }
    .details-media-panel img#modalLargeImage { height: 350px; }
}

@media (max-width: 767px) {
    .reviews-section-title { font-size: 26px; }
    .rating-number { font-size: 28px; }
    .dist-stars { width: 80px; }
    .dist-bar-bg { margin: 0 10px; }
    .modal-dialog-large { margin: 10px; }
}

/* Flash messages */
.cr-flash { border-radius: 10px; padding: 14px 18px; margin-bottom: 25px; font-size: 14px; font-weight: 600; }
.cr-flash-success { background: rgba(212, 175, 55, 0.12); color: #8a6d1a; border: 1px solid rgba(212, 175, 55, 0.4); }
.cr-flash-error { background: #fdf2f2; color: #b02a2a; border: 1px solid #f5c2c2; }
.cr-flash ul { list-style: disc; }

/* Star filter pills (client-side) */
.review-filters { display: flex; flex-wrap: wrap; gap: 8px; }
.filter-pill {
    background: #fff; border: 1px solid #eaeaea; color: #555; padding: 7px 16px; border-radius: 20px;
    font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;
}
.filter-pill:hover { border-color: #D4AF37; color: #111; }
.filter-pill.active { background: #111; color: #D4AF37; border-color: #111; }
.filter-pill i { font-size: 11px; }

/* Empty states */
.review-empty { color: #888; font-size: 15px; padding: 30px 0; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Selectors
    const createReviewModal = document.getElementById('createReviewModal');
    const photoDetailsModal = document.getElementById('photoDetailsModal');
    const modalLargeImage = document.getElementById('modalLargeImage');

    // Trigger buttons
    const createReviewBtns = document.querySelectorAll('.open-create-review');
    const photoThumbnails = document.querySelectorAll('.open-photo-details');
    const closeBtns = document.querySelectorAll('.close-modal, .close-modal-float');

    // Open Create Review Modal
    createReviewBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            createReviewModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Open Photo Details Modal
    photoThumbnails.forEach(thumb => {
        thumb.addEventListener('click', (e) => {
            e.preventDefault();
            const imgSrc = thumb.getAttribute('data-photo') || thumb.querySelector('img').src;
            modalLargeImage.src = imgSrc;
            photoDetailsModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close Modals
    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            createReviewModal.classList.remove('active');
            photoDetailsModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });

    // Click outside to close
    window.addEventListener('click', (e) => {
        if (e.target === createReviewModal || e.target === photoDetailsModal) {
            createReviewModal.classList.remove('active');
            photoDetailsModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Star Rating Interactivity — writes the selected value into the hidden input.
    const stars = document.querySelectorAll('.star-rating-input i');
    const ratingInput = document.getElementById('reviewRatingInput');
    const paintStars = (count) => {
        stars.forEach((s, i) => {
            s.classList.toggle('active', i < count);
            s.classList.toggle('fas', i < count);
            s.classList.toggle('far', i >= count);
        });
    };
    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => paintStars(index + 1));
        star.addEventListener('click', () => {
            if (ratingInput) ratingInput.value = index + 1;
            paintStars(index + 1);
        });
    });
    // Reflect any previously selected rating (e.g. after a validation redirect).
    if (ratingInput && parseInt(ratingInput.value, 10) > 0) {
        paintStars(parseInt(ratingInput.value, 10));
    }

    // File input — show the chosen filename in the upload placeholder.
    const fileInput = document.getElementById('reviewImageInput');
    if (fileInput) {
        fileInput.addEventListener('change', () => {
            const label = document.querySelector('.upload-text');
            if (label) label.textContent = fileInput.files.length ? fileInput.files[0].name : 'Click to upload image';
        });
    }

    // Star filters — client-side show/hide by data-rating. Zero requests.
    const filterPills = document.querySelectorAll('#reviewFilters .filter-pill');
    const reviewCards = document.querySelectorAll('#reviewList .review-card-item');
    const noMatches = document.querySelector('.review-no-matches');
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            filterPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            const filter = pill.getAttribute('data-filter');
            let visible = 0;
            reviewCards.forEach(card => {
                const show = (filter === 'all') || (card.getAttribute('data-rating') === filter);
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            if (noMatches) noMatches.style.display = (reviewCards.length && visible === 0) ? 'block' : 'none';
        });
    });

    // Re-open the Create Review modal automatically if the submission failed validation.
    @if($errors->any())
        if (createReviewModal) {
            createReviewModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    @endif
});
</script>
