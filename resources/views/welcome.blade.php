@extends('layouts.app')

@section('title', 'Fashion Shop - Home')

@section('content')

	<!--=========================-->
	<!--=        Slider         =-->
	<!--=========================-->

	<section class="slider-wrapper" data-aos="fade-in" data-aos-duration="1000">
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
								<a class="animated {{ $slider->animation }} btn-two" href="{{ $slider->button_link }}">
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
								<h4 class="animated fadeInUp"><span>BRAND NEW</span> COLLECTION</h4>
								<h1 class="animated fadeInUp">COMERCIO SHOP</h1>
								<p class="animated fadeInUp">Autem vel eum iriure dolor in molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
								<a class="animated fadeInUp btn-two" href="{{ route('collection') }}">SHOP NOW</a>
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
	<section class="feature-icons-section" style="padding: 60px 0; background: #f8f9fa;" data-aos="fade-up" data-aos-duration="800">
		<div class="container">
			<div class="row">
				@foreach($featureIcons as $feature)
				<div class="col-6 col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}" data-aos-duration="600">
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
	<!--=        Product Filter      =-->
	<!--=========================-->

	<section class="main-product" data-aos="fade-up" data-aos-duration="800">
		<div class="container container-two">
			<div class="section-heading" data-aos="fade-down" data-aos-duration="600">
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
							@forelse($featuredProducts as $product)
								<!-- single product -->
								<div class="grid-item col-6 col-md-6 col-lg-4 col-xl-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 150 }}" data-aos-duration="600">
									<div class="sin-product style-one">
										<div class="pro-img" style="height: 250px; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center;">
											<a href="{{ route('product.show', $product->slug) }}">
												<img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/1.jpg') }}" 
													alt="{{ $product->name }}"
													loading="lazy"
													style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
											</a>
											@if($product->stock === 0)
												<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10;">OUT OF STOCK</span>
											@elseif($product->discount_percentage > 0)
												<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10; font-size: 14px; font-weight: bold; color: white;">{{ $product->discount_percentage }}% OFF</span>
											@endif
										</div>
										<div class="mid-wrapper">
											<h5 class="pro-title" style="font-size: 20px; font-weight: 900; color: #222; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
												<a href="{{ route('product.show', $product->slug) }}" style="color: #222; text-decoration: none; font-weight: 900;">{{ $product->name }}</a>
											</h5>
										<div class="price-section">
											@if($product->discount_percentage > 0)
												<div class="mb-1">
													<span style="color: #e74c3c; font-size: 18px; font-weight: bold; text-decoration: line-through; text-decoration-color: #e74c3c; text-decoration-thickness: 3px;">
														${{ number_format($product->price, 2) }}
													</span>
												</div>
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 24px; font-weight: bold; letter-spacing: 1px;">
														${{ number_format($product->sale_price, 2) }}
													</span>
												</div>
											@else
												<div class="mb-1">
													<span style="color: #27ae60; font-size: 24px; font-weight: bold; letter-spacing: 1px;">
														${{ number_format($product->price, 2) }}
													</span>
												</div>
											@endif
										</div>
										</div>
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
		</div>
		<!-- Container  -->
	</section>
	<!-- main-product -->

	<!--=========================-->
	<!--=   Promotional Banners (Dynamic)   =-->
	<!--=========================-->

	@foreach($promoBannersAfterProducts as $banner)
	<section class="add-area" style="position: relative; overflow: hidden;" data-aos="fade-up" data-aos-duration="800">
		@if($banner->media_type === 'video')
			{{-- Video Banner --}}
			@if($banner->video_url)
				{{-- External Video (YouTube/Vimeo) --}}
				@php
					$videoId = '';
					$videoType = '';
					if (strpos($banner->video_url, 'youtube.com') !== false || strpos($banner->video_url, 'youtu.be') !== false) {
						preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $banner->video_url, $matches);
						$videoId = $matches[1] ?? '';
						$videoType = 'youtube';
					} elseif (strpos($banner->video_url, 'vimeo.com') !== false) {
						preg_match('/vimeo\.com\/(\d+)/', $banner->video_url, $matches);
						$videoId = $matches[1] ?? '';
						$videoType = 'vimeo';
					}
				@endphp
				
				@if($videoType === 'youtube' && $videoId)
					<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
						<iframe 
							src="https://www.youtube.com/embed/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&playlist=' . $videoId . '&' : '' }}{{ $banner->muted ? 'mute=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}rel=0&modestbranding=1" 
							style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
							allowfullscreen>
						</iframe>
					</div>
				@elseif($videoType === 'vimeo' && $videoId)
					<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
						<iframe 
							src="https://player.vimeo.com/video/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&' : '' }}{{ $banner->muted ? 'muted=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}" 
							style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
							allow="autoplay; fullscreen; picture-in-picture" 
							allowfullscreen>
						</iframe>
					</div>
				@endif
			@elseif($banner->video)
				{{-- Uploaded Video File --}}
				@if($banner->link_url && !$banner->button_text)
					<a href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="display: block;">
						<video 
							style="width: 100%; display: block; object-fit: cover;"
							{{ $banner->autoplay ? 'autoplay' : '' }}
							{{ $banner->loop ? 'loop' : '' }}
							{{ $banner->muted ? 'muted' : '' }}
							{{ $banner->show_controls ? 'controls' : '' }}
							{{ $banner->video_thumbnail ? 'poster=' . asset('storage/' . $banner->video_thumbnail) : '' }}
							playsinline>
							<source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</a>
				@else
					<video 
						style="width: 100%; display: block; object-fit: cover;"
						{{ $banner->autoplay ? 'autoplay' : '' }}
						{{ $banner->loop ? 'loop' : '' }}
						{{ $banner->muted ? 'muted' : '' }}
						{{ $banner->show_controls ? 'controls' : '' }}
						{{ $banner->video_thumbnail ? 'poster=' . asset('storage/' . $banner->video_thumbnail) : '' }}
						playsinline>
						<source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				@endif
			@endif
		@else
			{{-- Image Banner --}}
			@if($banner->image)
				@if($banner->link_url && !$banner->button_text)
					<a href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="display: block;">
						<img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" loading="lazy" style="width: 100%; display: block;">
					</a>
				@else
					<img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" loading="lazy" style="width: 100%; display: block;">
				@endif
			@endif
		@endif
		
		@if($banner->small_title || $banner->main_title || $banner->description || $banner->button_text)
		<div class="container-fluid custom-container" style="position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); pointer-events: none; z-index: 10;">
			<div class="row align-items-center">
				<div class="col-12 col-sm-8 col-md-8 col-lg-6 {{ $banner->text_alignment === 'right' ? 'ml-auto' : ($banner->text_alignment === 'center' ? 'mx-auto' : '') }}">
					<div class="banner-text" style="text-align: {{ $banner->text_alignment }}; pointer-events: auto;">
						@if($banner->small_title)
						<h4 class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 18px; text-transform: uppercase; margin-bottom: 10px;">
							<span>{{ $banner->small_title }}</span>
						</h4>
						@endif
						
						@if($banner->main_title)
						<h1 class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 48px; font-weight: 700; margin-bottom: 15px; line-height: 1.2;">
							{{ $banner->main_title }}
						</h1>
						@endif
						
						@if($banner->description)
						<p class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 16px; margin-bottom: 20px; line-height: 1.6;">
							{{ $banner->description }}
						</p>
						@endif
						
						@if($banner->button_text && $banner->link_url)
						<a class="animated fadeInUp btn-two" href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }}>
							{{ $banner->button_text }}
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		@endif
	</section>
	@endforeach

	<!--=========================-->
	<!--=   Small Product area    =-->
	<!--=========================-->

	<section class="product-small" data-aos="fade-up" data-aos-duration="800">
		<div class="container-fluid  custom-container">
			<div class="row">
				<div class="col-12">
					<div class="small-sec-title text-center" data-aos="fade-down" data-aos-duration="600">
						<h6><span style="color: #FFD700;">⭐ FEATURED CUSTOMER REVIEWS</span></h6>
						<p style="color: #666; font-size: 14px; margin-top: 10px;">See what our customers are saying about their favorite products</p>
					</div>
				</div>
			</div>
			
			<div class="row">
				@forelse($featuredReviews as $review)
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 200 }}" data-aos-duration="600">
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
									<img src="{{ $review->product->primary_image ? asset('storage/' . $review->product->primary_image) : asset('media/images/product/default.jpg') }}" 
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
								<i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#FFD700' : '#ddd' }}; font-size: 18px;"></i>
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
							<div class="reviewer-avatar" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 16px; margin-right: 12px;">
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
				
				@empty
				<div class="col-12">
					<div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 12px;">
						<i class="fas fa-star" style="font-size: 60px; color: #ddd; margin-bottom: 20px;"></i>
						<h4 style="color: #666; margin-bottom: 15px;">No Featured Reviews Yet</h4>
						<p style="color: #999; font-size: 16px;">Pin reviews from the admin dashboard to showcase them here!</p>
						@auth
							@if(auth()->user()->role === 'admin')
								<a href="{{ url('/admin/reviews') }}" style="display: inline-block; margin-top: 20px; background: #000; color: #FFD700; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 700;">
									GO TO ADMIN DASHBOARD
								</a>
							@endif
						@endauth
					</div>
				</div>
				@endforelse
			</div>
			<!-- row -->
		</div>
		<!-- container-fluid End-->
	</section>

	<!--=========================-->
	<!--=   Promotional Banners After Reviews (Dynamic)   =-->
	<!--=========================-->

	@foreach($promoBannersAfterReviews as $banner)
	<section class="add-area" style="position: relative; overflow: hidden;" data-aos="fade-up" data-aos-duration="800">
		@if($banner->media_type === 'video')
			{{-- Video Banner --}}
			@if($banner->video_url)
				{{-- External Video (YouTube/Vimeo) --}}
				@php
					$videoId = '';
					$videoType = '';
					if (strpos($banner->video_url, 'youtube.com') !== false || strpos($banner->video_url, 'youtu.be') !== false) {
						preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $banner->video_url, $matches);
						$videoId = $matches[1] ?? '';
						$videoType = 'youtube';
					} elseif (strpos($banner->video_url, 'vimeo.com') !== false) {
						preg_match('/vimeo\.com\/(\d+)/', $banner->video_url, $matches);
						$videoId = $matches[1] ?? '';
						$videoType = 'vimeo';
					}
				@endphp
				
				@if($videoType === 'youtube' && $videoId)
					<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
						<iframe 
							src="https://www.youtube.com/embed/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&playlist=' . $videoId . '&' : '' }}{{ $banner->muted ? 'mute=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}rel=0&modestbranding=1" 
							style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
							allowfullscreen>
						</iframe>
					</div>
				@elseif($videoType === 'vimeo' && $videoId)
					<div style="position: relative; padding-bottom: 42.86%; height: 0; overflow: hidden;">
						<iframe 
							src="https://player.vimeo.com/video/{{ $videoId }}?{{ $banner->autoplay ? 'autoplay=1&' : '' }}{{ $banner->loop ? 'loop=1&' : '' }}{{ $banner->muted ? 'muted=1&' : '' }}{{ $banner->show_controls ? '' : 'controls=0&' }}" 
							style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
							allow="autoplay; fullscreen; picture-in-picture" 
							allowfullscreen>
						</iframe>
					</div>
				@endif
			@elseif($banner->video)
				{{-- Uploaded Video File --}}
				@if($banner->link_url && !$banner->button_text)
					<a href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="display: block;">
						<video 
							style="width: 100%; display: block; object-fit: cover;"
							{{ $banner->autoplay ? 'autoplay' : '' }}
							{{ $banner->loop ? 'loop' : '' }}
							{{ $banner->muted ? 'muted' : '' }}
							{{ $banner->show_controls ? 'controls' : '' }}
							{{ $banner->video_thumbnail ? 'poster=' . asset('storage/' . $banner->video_thumbnail) : '' }}
							playsinline>
							<source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</a>
				@else
					<video 
						style="width: 100%; display: block; object-fit: cover;"
						{{ $banner->autoplay ? 'autoplay' : '' }}
						{{ $banner->loop ? 'loop' : '' }}
						{{ $banner->muted ? 'muted' : '' }}
						{{ $banner->show_controls ? 'controls' : '' }}
						{{ $banner->video_thumbnail ? 'poster=' . asset('storage/' . $banner->video_thumbnail) : '' }}
						playsinline>
						<source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				@endif
			@endif
		@else
			{{-- Image Banner --}}
			@if($banner->image)
				@if($banner->link_url && !$banner->button_text)
					<a href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="display: block;">
						<img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" loading="lazy" style="width: 100%; display: block;">
					</a>
				@else
					<img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->alt_text }}" loading="lazy" style="width: 100%; display: block;">
				@endif
			@endif
		@endif
		
		@if($banner->small_title || $banner->main_title || $banner->description || $banner->button_text)
		<div class="container-fluid custom-container" style="position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); pointer-events: none; z-index: 10;">
			<div class="row align-items-center">
				<div class="col-12 col-sm-8 col-md-8 col-lg-6 {{ $banner->text_alignment === 'right' ? 'ml-auto' : ($banner->text_alignment === 'center' ? 'mx-auto' : '') }}">
					<div class="banner-text" style="text-align: {{ $banner->text_alignment }}; pointer-events: auto;">
						@if($banner->small_title)
						<h4 class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 18px; text-transform: uppercase; margin-bottom: 10px;">
							<span>{{ $banner->small_title }}</span>
						</h4>
						@endif
						
						@if($banner->main_title)
						<h1 class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 48px; font-weight: 700; margin-bottom: 15px; line-height: 1.2;">
							{{ $banner->main_title }}
						</h1>
						@endif
						
						@if($banner->description)
						<p class="animated fadeInUp" style="color: {{ $banner->text_color }}; font-size: 16px; margin-bottom: 20px; line-height: 1.6;">
							{{ $banner->description }}
						</p>
						@endif
						
						@if($banner->button_text && $banner->link_url)
						<a class="animated fadeInUp btn-two" href="{{ $banner->link_url }}" {{ $banner->open_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }}>
							{{ $banner->button_text }}
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		@endif
	</section>
	@endforeach

@endsection
