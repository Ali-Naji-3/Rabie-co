@extends('layouts.app')

@section('title', 'Contact Us - Fashion Shop')

@push('styles')
<style>
	/* Contact Information Hover Effects */
	.contact-info-item a:hover {
		color: #000000 !important;
	}
	
	.contact-info-item .icon-wrapper {
		transition: all 0.3s ease;
	}
	
	.contact-info-item:hover .icon-wrapper {
		transform: scale(1.1);
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
	}
	
	/* Social Media Hover Effects */
	.contact-info-wrapper a[href*="facebook"]:hover,
	.contact-info-wrapper a[href*="instagram"]:hover,
	.contact-info-wrapper a[href*="twitter"]:hover,
	.contact-info-wrapper a[href*="linkedin"]:hover,
	.contact-info-wrapper a[href*="youtube"]:hover,
	.contact-info-wrapper a[href*="tiktok"]:hover {
		transform: translateY(-3px);
		box-shadow: 0 6px 16px rgba(0,0,0,0.2) !important;
	}
	
	/* Contact Form Styling */
	.contact-form input[type="text"],
	.contact-form input[type="tel"],
	.contact-form select,
	.contact-form textarea {
		transition: all 0.3s ease;
	}
	
	.contact-form input[type="text"]:focus,
	.contact-form input[type="tel"]:focus,
	.contact-form select:focus,
	.contact-form textarea:focus {
		border-color: #f53003 !important;
		box-shadow: 0 0 8px rgba(245, 48, 3, 0.2);
		outline: none;
	}
	
	.contact-form input[type="submit"] {
		transition: all 0.3s ease;
		background: #000000 !important;
		border: none;
		color: white !important;
		padding: 15px 60px;
		font-size: 14px;
		font-weight: 700;
		border-radius: 5px;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		min-width: 240px;
		white-space: nowrap;
	}
	
	.contact-form input[type="submit"]:hover {
		background: #333333 !important;
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
	}
	
	/* Responsive Adjustments */
	@media (max-width: 767px) {
		.contact-info-item .icon-wrapper {
			width: 50px !important;
			height: 50px !important;
		}
		
		.contact-info-item h6 {
			font-size: 14px !important;
		}
		
		.contact-info-item a,
		.contact-info-item p {
			font-size: 13px !important;
		}
	}
</style>
@endpush

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area" data-aos="fade-down" data-aos-duration="600">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="#">Home  |</a> Shop</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->



	<!--Contact area
============================================= -->
	<section class="contact-area" data-aos="fade-up" data-aos-duration="800">
		<div class="container-fluid custom-container">
			<div class="section-heading pb-30 text-center" data-aos="fade-down" data-aos-duration="600">
				<h3>Get in <span>Touch</span></h3>
				<p>We'd love to hear from you. Contact us for any questions or concerns.</p>
			</div>

			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fas fa-check-circle"></i> {{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			@if($errors->any())
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fas fa-exclamation-circle"></i> 
					<ul class="mb-0">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			<div class="row justify-content-center">
				<!-- Contact Form Section -->
				<div class="col-lg-10 col-xl-8 mb-5" data-aos="zoom-in" data-aos-duration="800">
					<div class="contact-form" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
						<h4 style="color: #1b1b18; font-size: 24px; font-weight: 700; margin-bottom: 25px;">Send us a Message</h4>
						<form action="{{ route('contact.store') }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-xl-6">
									<input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name*" required>
								</div>
								<div class="col-xl-6">
									<input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name*" required>
								</div>
								<div class="col-xl-6">
									<input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone Number*" required>
								</div>
								<div class="col-xl-6">
									<select name="subject" required style="padding: 15px; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 14px; color: #666; background: white;">
										<option value="">Select Subject*</option>
										<option value="order_inquiry" {{ old('subject') == 'order_inquiry' ? 'selected' : '' }}>Order Inquiry</option>
										<option value="product_question" {{ old('subject') == 'product_question' ? 'selected' : '' }}>Product Question</option>
										<option value="shipping_issue" {{ old('subject') == 'shipping_issue' ? 'selected' : '' }}>Shipping Issue</option>
										<option value="return_refund" {{ old('subject') == 'return_refund' ? 'selected' : '' }}>Return/Refund</option>
										<option value="general_question" {{ old('subject') == 'general_question' ? 'selected' : '' }}>General Question</option>
										<option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Complaint</option>
										<option value="partnership_business" {{ old('subject') == 'partnership_business' ? 'selected' : '' }}>Partnership/Business</option>
									</select>
								</div>
								<div class="col-xl-12">
									<textarea name="message" placeholder="Message*" required>{{ old('message') }}</textarea>
								</div>
								<div class="col-xl-12">
									<input type="submit" value="SEND MESSAGE">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Contact Information Section -->
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8" data-aos="fade-up" data-aos-duration="800">
					<div class="contact-info-wrapper" style="background: #f8f9fa; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
						<h4 style="color: #1b1b18; font-size: 24px; font-weight: 700; margin-bottom: 30px; text-align: center; border-bottom: 3px solid #000000; display: inline-block; padding-bottom: 10px; width: 100%; text-align: center;" data-aos="fade-down" data-aos-duration="600">Contact Information</h4>
						
						<div class="row" style="margin-top: 30px;">
							<!-- Phone -->
							@if($siteSettings->phone)
							<div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="600">
								<div class="contact-info-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
									<div class="icon-wrapper" style="background: #000000; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
										<i class="fas fa-mobile-alt" style="font-size: 24px;"></i>
									</div>
									<h6 style="color: #333; font-weight: 600; margin-bottom: 8px; font-size: 16px;">Phone</h6>
									<a href="tel:{{ $siteSettings->phone }}" style="color: #666; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ $siteSettings->phone }}</a>
								</div>
							</div>
							@endif

							<!-- Email -->
							@if($siteSettings->email)
							<div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="600">
								<div class="contact-info-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
									<div class="icon-wrapper" style="background: #000000; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
										<i class="fas fa-envelope" style="font-size: 24px;"></i>
									</div>
									<h6 style="color: #333; font-weight: 600; margin-bottom: 8px; font-size: 16px;">Email</h6>
									<a href="mailto:{{ $siteSettings->email }}" style="color: #666; text-decoration: none; font-size: 15px; word-break: break-word; transition: all 0.3s;">{{ $siteSettings->email }}</a>
								</div>
							</div>
							@endif

							<!-- WhatsApp -->
							@if($siteSettings->whatsapp)
							<div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="600">
								<div class="contact-info-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
									<div class="icon-wrapper" style="background: #000000; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
										<i class="fab fa-whatsapp" style="font-size: 28px;"></i>
									</div>
									<h6 style="color: #333; font-weight: 600; margin-bottom: 8px; font-size: 16px;">WhatsApp</h6>
									<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp) }}" target="_blank" style="color: #666; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ $siteSettings->whatsapp }}</a>
								</div>
							</div>
							@endif

							<!-- Address -->
							@if($siteSettings->address)
							<div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="400" data-aos-duration="600">
								<div class="contact-info-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
									<div class="icon-wrapper" style="background: #000000; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
										<i class="fas fa-map-marker-alt" style="font-size: 24px;"></i>
									</div>
									<h6 style="color: #333; font-weight: 600; margin-bottom: 8px; font-size: 16px;">Address</h6>
									<p style="color: #666; margin: 0; font-size: 15px; line-height: 1.6;">{{ $siteSettings->address }}</p>
								</div>
							</div>
							@endif

							<!-- Working Hours -->
							@if($siteSettings->working_hours)
							<div class="col-md-6 col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="500" data-aos-duration="600">
								<div class="contact-info-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
									<div class="icon-wrapper" style="background: #000000; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
										<i class="fas fa-clock" style="font-size: 24px;"></i>
									</div>
									<h6 style="color: #333; font-weight: 600; margin-bottom: 8px; font-size: 16px;">Working Hours</h6>
									<p style="color: #666; margin: 0; font-size: 15px; line-height: 1.6; white-space: pre-line;">{{ $siteSettings->working_hours }}</p>
								</div>
							</div>
							@endif
						</div>

					</div>
				</div>
			</div>
			<!-- /.row end -->
		</div>
		<!-- /.container-fluid end -->
	</section>
	<!-- /.contact-area end -->







		<!--=========================-->

@endsection
