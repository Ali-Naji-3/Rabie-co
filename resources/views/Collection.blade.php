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
								<!-- Grid View -->
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="row">
										@forelse($products as $product)
										<div class="col-sm-6 col-xl-3">
											<div class="sin-product style-two">
												<div class="pro-img">
													<a href="{{ route('product.show', $product->slug) }}">
														<img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/sp1.jpg') }}" 
															alt="{{ $product->name }}" 
															loading="lazy"
															style="max-width: 100%; height: auto;">
													</a>
												</div>
												@if($product->stock === 0)
													<span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10;">OUT OF STOCK</span>
												@elseif($product->sale_price)
													<span class="badge bg-success" style="position: absolute; top: 10px; left: 10px; z-index: 10;">SALE!</span>
												@endif
												<div class="mid-wrapper">
													<h5 class="pro-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h5>
													<div class="color-variation">
														<ul>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
															<li><i class="fas fa-circle"></i></li>
														</ul>
													</div>
													<p>{{ $product->category->name }} / 
														@if($product->sale_price)
															<del style="color: #999;">${{ number_format($product->price, 2) }}</del>
															<span style="color: #e74c3c; font-weight: bold;">${{ number_format($product->sale_price, 2) }}</span>
														@else
															<span>${{ number_format($product->price, 2) }}</span>
														@endif
													</p>
												</div>
												<div class="icon-wrapper">
													<div class="pro-icon">
														<ul>
															<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
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
										<div class="col-12 d-flex justify-content-center">
											{{ $products->links() }}
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
								
								<!-- List View -->
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="row no-gutters">
										@forelse($products as $product)
										<div class="col-xl-9">
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
																<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>
																<li><a href="{{ route('product.show', $product->slug) }}"><i class="flaticon-eye"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="col-md-7 col-lg-6 col-xl-8">
														<div class="list-pro-det">
															<h5 class="pro-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h5>
															<span>
																@if($product->sale_price)
																	<del>${{ number_format($product->price, 2) }}</del>
																	<strong style="color: #e74c3c;">${{ number_format($product->sale_price, 2) }}</strong>
																@else
																	${{ number_format($product->price, 2) }}
																@endif
															</span>
															<div class="rating">
																<ul>
																	@php
																		$avgRating = $product->reviews()->where('is_approved', true)->avg('rating') ?? 0;
																	@endphp
																	@for($i = 1; $i <= 5; $i++)
																		<li><i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}"></i></li>
																	@endfor
																</ul>
															</div>
															<p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 200) }}</p>
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
										<div class="col-12 d-flex justify-content-center">
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
