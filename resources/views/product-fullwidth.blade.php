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
											<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">REVIEWS (1)</a>
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
												<h5>Review (1)</h5>
												<div class="product-review">
													<div class="reviwer">
														<img src="media/images/reviewer.png" alt="">
														<div class="review-details">
															<span>Posted by Tonoy - Published on	March 22, 2018</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="far fa-star"></i></a></li>
																	<li><a href="#"><i class="far fa-star"></i></a></li>
																	<li><a href="#"><i class="far fa-star"></i></a></li>
																	<li><a href="#"><i class="far fa-star"></i></a></li>
																	<li><a href="#"><i class="far fa-star"></i></a></li>
																</ul>
															</div>
															<p>But I must explain to you how all this mistaken idea of denouncipleasure and praisi pain was born and I will give you a complete.</p>
														</div>
													</div>
													<div class="add-your-review">
														<h6>ADD A REVIEW</h6>
														<p>YOUR RATING* </p>
														<div class="rating">
															<ul>
																<li><a href="#"><i class="far fa-star"></i></a></li>
																<li><a href="#"><i class="far fa-star"></i></a></li>
																<li><a href="#"><i class="far fa-star"></i></a></li>
																<li><a href="#"><i class="far fa-star"></i></a></li>
																<li><a href="#"><i class="far fa-star"></i></a></li>
															</ul>
														</div>

														<div class="raing-form">
															<form action="#">
																<input type="text" placeholder="">
																<input type="text">
																<textarea name="rating-form"></textarea>
																<input type="submit">
															</form>
														</div>
													</div>
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
		<!--=   Subscribe area      =-->
		<!--=========================-->

		<section class="subscribe-area style-two">
			<div class="container container-two">
				<div class="row">
					<div class="col-lg-5">
						<div class="subscribe-text">
							<h6>Join our newsletter</h6>
						</div>
					</div>
					<!-- col-xl-6 -->

					<div class="col-lg-7">
						<div class="subscribe-wrapper">
							<input placeholder="Enter Keyword" type="text">
							<button type="submit">SUBSCRIBE</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container-two -->
		</section>
		<!-- subscribe-area -->

		<!--=========================-->

@endsection
