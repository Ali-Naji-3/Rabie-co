@extends('layouts.app')

@section('title', 'Product Details - Fashion Shop')

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
		<!--=        Shop area          =-->
		<!--=========================-->

		<section class="shop-area style-two">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-lg-6 col-xl-6">
								<!-- Product View Slider -->
								<div class="quickview-slider">
									<div class="slider-for">
										<div class="">
											<img src="media/images/product/single/b1.jpg" alt="Thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b2.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b3.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b4.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b5.jpg" alt="Thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b1.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b2.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b3.jpg" alt="thumb">
										</div>
									</div>

									<div class="slider-nav">

										<div class="">
											<img src="media/images/product/single/b1.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b2.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b3.jpg" alt="thumb">
										</div>
										<div class="">
											<div class="">
												<img src="media/images/product/single/b4.jpg" alt="Thumb">
											</div>
										</div>
										<div class="">
											<img src="media/images/product/single/b5.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b1.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b2.jpg" alt="thumb">
										</div>
										<div class="">
											<img src="media/images/product/single/b3.jpg" alt="thumb">
										</div>
									</div>
								</div>
								<!-- /.quickview-slider -->
							</div>
							<!-- /.col-xl-6 -->

							<div class="col-lg-6 col-xl-6">
								<div class="product-details">
									<h5 class="pro-title"><a href="#">Woman fashion dress</a></h5>
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
											<input type="text" value="0" name="qtybutton" class="cart-plus-minus">
										</div>
										<a href="#" class="add-to-cart"><i class="flaticon-shopping-purse-icon"></i>Add to Cart</a>
										<!-- <a href="#"><i class="flaticon-valentines-heart"></i></a> -->
									</div>

									<!-- <span>SKU:	N/A</span>
								<p>Tags <a href="#">boys,</a><a href="#"> dress,</a><a href="#">Rok-dress</a></p> -->

									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam,nisi ut aliquip ex ea commodo consequat.Excepteur sint occaecat cupidatat non proident, sunt in culpa
										qui officia deserunt mollit anim id est laborum.</p>
									<ul>
										<li>Lorem ipsum dolor sit amet</li>
										<li>quis nostrud exercitation ullamco</li>
										<li>Duis aute irure dolor in reprehenderit</li>
									</ul>
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


							<div class="col-xl-12">
								<div class="product-des-tab">
									<ul class="nav nav-tabs " role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DESCRIPTION</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDITIONAL INFORMATION</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">REVIEWS (3)</a>
										</li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
											<div class="prod-bottom-tab-sin description">
												<h5>Description</h5>
												<p>But I must explain to you how all this mistaken idea of denouncipleasure and praisi pain was born and I will give you a complete accoun syste and expound the actu teachings of the great explorer of tmaster-builder of human happiness. No one
													rejects, dislikes, or avoids pleasure beca pleasure, but because those how.But I must explain to you how all this mistaken idea of denouncipleasure and praisi pain was born and I will give you a complete accoun system, and expound the actu
													teachings of the great explorer of tmaster-builder.</p>
												<p>But I must explain to you how all this taken idea of denouncipleasure and praisi pain was born and I will give you a complete accoun syste and expound the actu teachings of the great explorer mistaken idea of denouncipleasure and praisi pain</p>
												<ul>
													<li>Lorem ipsum dolor sit amet</li>
													<li>quis nostrud exercitation ullamco</li>
													<li>Duis aute irure dolor in reprehenderit</li>
													<li>Lorem ipsum dolor sit amet</li>
												</ul>
												<p>Lorem ipsum dolor sit amet Duis aute irure dolor in denouncipleasure and praisi pain was born.Lorem ipsum dolor sit amet Duis aute irure dolor in denouncipleasure and praisi pain was born.</p>
											</div>


										</div>
										<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="prod-bottom-tab-sin">
												<h5>Additional information</h5>
												<div class="info-wrap">
													<div class="sin-aditional-info">
														<div class="first">
															Brand
														</div>
														<div class="secound">
															ThemeIM
														</div>
													</div>
													<div class="sin-aditional-info">
														<div class="first">
															Manufacturer
														</div>
														<div class="secound">
															ThemeCity
														</div>
													</div>
													<div class="sin-aditional-info">
														<div class="first">
															Colors
														</div>
														<div class="secound">
															Black, Blue, Brown, Gray
														</div>
													</div>
													<div class="sin-aditional-info">
														<div class="first">
															Brand
														</div>
														<div class="secound">
															ThemeIM
														</div>
													</div>
													<div class="sin-aditional-info">
														<div class="first">
															Brand
														</div>
														<div class="secound">
															ThemeIM
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
											<div class="prod-bottom-tab-sin">
												<!-- Review Summary Section -->
												<div class="review-summary-section mb-4" style="background: #f8f9fa; padding: 25px; border-radius: 12px; border-left: 4px solid #007bff;">
													<div class="row align-items-center">
														<!-- Average Rating -->
														<div class="col-md-4 text-center">
															<div class="average-rating">
																<h2 style="color: #007bff; font-weight: 700; margin: 0; font-size: 48px;">5.0</h2>
																<div class="stars mb-2">
																	<i class="fas fa-star" style="color: #ffc107; font-size: 20px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 20px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 20px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 20px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 20px;"></i>
																</div>
																<p style="color: #666; margin: 0; font-size: 14px;">Average Rating</p>
															</div>
														</div>
														
														<!-- Total Reviews -->
														<div class="col-md-4 text-center">
															<div class="total-reviews">
																<h2 style="color: #28a745; font-weight: 700; margin: 0; font-size: 48px;">3</h2>
																<p style="color: #666; margin: 0; font-size: 14px;">Total Reviews</p>
															</div>
														</div>
														
														<!-- Recommended -->
														<div class="col-md-4 text-center">
															<div class="recommended">
																<h2 style="color: #28a745; font-weight: 700; margin: 0; font-size: 48px;">3</h2>
																<p style="color: #666; margin: 0; font-size: 14px;">Recommended</p>
															</div>
														</div>
													</div>
												</div>

												<!-- Individual Reviews -->
												<div class="reviews-list">
													<!-- Review 1 -->
													<div class="review-card mb-4" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
														<div class="review-header d-flex justify-content-between align-items-start mb-3">
															<div class="review-rating">
																<div class="stars mb-2">
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																</div>
																<span style="color: #666; font-size: 14px;">5.0/5.0</span>
															</div>
															<span style="color: #999; font-size: 14px;">Published 1 week ago</span>
														</div>
														
														<div class="review-content">
															<h6 style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; font-size: 18px;">"Excellent Product!"</h6>
															<p style="color: #666; line-height: 1.6; margin-bottom: 15px;">This product exceeded my expectations. The quality is outstanding and delivery was fast!</p>
														</div>
														
														<div class="review-footer d-flex justify-content-between align-items-center">
															<div class="reviewer-info d-flex align-items-center">
																<div class="user-avatar mr-2" style="width: 32px; height: 32px; background: #007bff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
																	<i class="fas fa-user" style="color: white; font-size: 14px;"></i>
																</div>
																<span style="color: #1b1b18; font-weight: 500;">Admin User</span>
															</div>
															<span class="recommendation-badge" style="background: #28a745; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 500;">Recommends</span>
														</div>
													</div>

													<!-- Review 2 -->
													<div class="review-card mb-4" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
														<div class="review-header d-flex justify-content-between align-items-start mb-3">
															<div class="review-rating">
																<div class="stars mb-2">
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																</div>
																<span style="color: #666; font-size: 14px;">5.0/5.0</span>
															</div>
															<span style="color: #999; font-size: 14px;">Published 2 weeks ago</span>
														</div>
														
														<div class="review-content">
															<h6 style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; font-size: 18px;">"Perfect Quality!"</h6>
															<p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Amazing quality and perfect fit. Highly recommend this product to anyone looking for premium quality.</p>
														</div>
														
														<div class="review-footer d-flex justify-content-between align-items-center">
															<div class="reviewer-info d-flex align-items-center">
																<div class="user-avatar mr-2" style="width: 32px; height: 32px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
																	<i class="fas fa-user" style="color: white; font-size: 14px;"></i>
																</div>
																<span style="color: #1b1b18; font-weight: 500;">Sarah Johnson</span>
															</div>
															<span class="recommendation-badge" style="background: #28a745; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 500;">Recommends</span>
														</div>
													</div>

													<!-- Review 3 -->
													<div class="review-card mb-4" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
														<div class="review-header d-flex justify-content-between align-items-start mb-3">
															<div class="review-rating">
																<div class="stars mb-2">
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																	<i class="fas fa-star" style="color: #ffc107; font-size: 16px;"></i>
																</div>
																<span style="color: #666; font-size: 14px;">5.0/5.0</span>
															</div>
															<span style="color: #999; font-size: 14px;">Published 3 weeks ago</span>
														</div>
														
														<div class="review-content">
															<h6 style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; font-size: 18px;">"Great Value!"</h6>
															<p style="color: #666; line-height: 1.6; margin-bottom: 15px;">Excellent value for money. The product quality is top-notch and the customer service was outstanding.</p>
														</div>
														
														<div class="review-footer d-flex justify-content-between align-items-center">
															<div class="reviewer-info d-flex align-items-center">
																<div class="user-avatar mr-2" style="width: 32px; height: 32px; background: #ffc107; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
																	<i class="fas fa-user" style="color: white; font-size: 14px;"></i>
																</div>
																<span style="color: #1b1b18; font-weight: 500;">Mike Chen</span>
															</div>
															<span class="recommendation-badge" style="background: #28a745; color: white; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 500;">Recommends</span>
														</div>
													</div>
												</div>

												<!-- Leave Review Button -->
												<div class="leave-review-section text-center mt-4">
													<a href="{{ route('write-review') }}" class="btn btn-primary btn-lg" style="background: #007bff; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
														<i class="fas fa-star mr-2"></i>
														Leave a review
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.col-xl-9 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.shop-area -->


		<!--=========================-->

@endsection
