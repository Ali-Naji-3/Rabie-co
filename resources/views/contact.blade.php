@extends('layouts.app')

@section('title', 'Contact Us - Fashion Shop')

@section('content')

		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
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
	<section class="contact-area">
		<div class="container-fluid custom-container">
			<div class="section-heading pb-30">
				<h3>join with <span>us</span></h3>
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
				<div class="col-md-8 col-lg-8 col-xl-6">
					<div class="contact-form">
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
									<input type="submit" value="SUBMIT">
								</div>
							</div>
						</form>
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
