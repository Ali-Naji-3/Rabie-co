@extends('layouts.app')

@section('title', 'Collection - Fashion Shop')

@section('content')

		<!--=========================-->
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

		<section class="shop-area">
			<div class="container-fluid custom-container">
				<div class="row">

					<div class="col-12">
						<div class="shop-sorting-area row">
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
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="row">

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp1.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Layered Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp2.jpg') }}" alt=""></a>
												</div>
												<span class="new-tag">NEW!</span>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Dungaree Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp3.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Cape Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp4.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Shift Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp5.jpg') }}" alt=""></a>
												</div>
												<span class="new-tag">NEW!</span>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Spaghetti Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp6.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">T-shirt Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp7.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Tulle Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp2.jpg') }}" alt=""></a>
												</div>
												<span class="new-tag">NEW!</span>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Wrap Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp1.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Laptop carry bag</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp2.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Bandeau Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp2.jpg') }}" alt=""></a>
												</div>
												<span class="new-tag">NEW!</span>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Sheath Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp3.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Blouson Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp1.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Layered Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp2.jpg') }}" alt=""></a>
												</div>
												<span class="new-tag">NEW!</span>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Dungaree Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp3.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Cape Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>

										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product') }}"><img src="{{ asset('media/images/product/sp4.jpg') }}" alt=""></a>
												</div>
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product') }}">Shift Dresses</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>Woman / <span>$387</span></p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
															<li><a href="#"><i class="flaticon-compare"></i></a></li>
															<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
														</ul>
													</div>
													<div class="add-to-cart">
														<a href="#">add to cart</a>
													</div>
												</div>
											</div>
											<!-- /.sin-product -->
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="row no-gutters">
										<div class="col-xl-9">
											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp1.jpg') }}" alt=""></a>
														</div>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="#">Tunic Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp2.jpg') }}" alt=""></a>
														</div>
														<span class="new-tag">NEW!</span>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product') }}">Pencil Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp3.jpg') }}" alt=""></a>
														</div>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product') }}">Asymmetric Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp1.jpg') }}" alt=""></a>
														</div>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product') }}">Trench Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp2.jpg') }}" alt=""></a>
														</div>
														<span class="new-tag">NEW!</span>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product') }}">Bandage Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp1.jpg') }}" alt=""></a>
														</div>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="#">Tunic Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

											<div class="sin-product list-pro">
												<div class="row">
													<div class="col-md-5 col-lg-6 col-xl-4">
														<div class="pro-img">
															<img src="{{ asset('media/images/product/lp2.jpg') }}" alt=""></a>
														</div>
														<span class="new-tag">NEW!</span>
														<div class="pro-icon">
															<ul>
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="#"><i class="flaticon-compare"></i></a></li>
																<li><a href="#" class="trigger"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product') }}">Pencil Dresses</a></h5>
															<span>$387</span>
															<div class="rating">
																<ul>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																	<li><a href="#"><i class="fas fa-star"></i></a></li>
																</ul>
															</div>
															<div class="color-variation">
																<ul>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																	<li><i class="fas fa-circle"></i></li>
																</ul>
															</div>
															<p>Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat vel illdolore eu olestie consequat feugiat nulla facilisis at vero eros.Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
																vel illum dolore eu olestie consequat feugiat nulla facilisis at vero eros.</p>
															<a class="btn-two" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<!-- /.row -->
											</div>
											<!-- /.sin-product-->

										</div>
										<!-- /.col-xl-12 -->
									</div>
									<!-- /.col-xl-12 -->
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
							<div class="load-more-wrapper">
								<a href="create-account.html" class="btn-two">Load More</a>
							</div>
							<!-- /.load-more-wrapper -->
						</div>
						<!-- /.shop-content -->
					</div>
					<!-- /.col-xl-9 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.shop-area -->


@endsection
