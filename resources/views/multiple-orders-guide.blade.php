@extends('layouts.app')

@section('title', 'Multiple Orders Guide - Fashion Shop')

@section('content')

<section class="guide-section" style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Guide Header -->
                <div class="guide-header" style="text-align: center; margin-bottom: 50px;">
                    <h1 style="color: #333; font-size: 42px; font-weight: 900; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 2px;">
                        Multiple Orders Guide
                    </h1>
                    <p style="color: #666; font-size: 18px;">
                        How to place multiple orders as a customer
                    </p>
                </div>

                <!-- Guide Steps -->
                <div class="guide-steps">
                    
                    <!-- Step 1 -->
                    <div class="step-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #FFD700;">
                        <div class="step-header" style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div class="step-number" style="width: 50px; height: 50px; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                <span style="color: #000; font-weight: 900; font-size: 20px;">1</span>
                            </div>
                            <h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 0;">Login to Your Account</h3>
                        </div>
                        <div class="step-content">
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                                Use your customer account to login:
                            </p>
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef;">
                                <strong>Email:</strong> ali@gmail.com<br>
                                <strong>Password:</strong> password
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #28a745;">
                        <div class="step-header" style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div class="step-number" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                <span style="color: #fff; font-weight: 900; font-size: 20px;">2</span>
                            </div>
                            <h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 0;">Place Your First Order</h3>
                        </div>
                        <div class="step-content">
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                                The account already has cart items ready for checkout:
                            </p>
                            <ul style="color: #666; font-size: 16px; line-height: 1.6; padding-left: 20px;">
                                <li>Go to <strong>Cart</strong> page</li>
                                <li>Click <strong>"Proceed To Checkout"</strong></li>
                                <li>Fill out the checkout form</li>
                                <li>Complete your first order</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #007bff;">
                        <div class="step-header" style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div class="step-number" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                <span style="color: #fff; font-weight: 900; font-size: 20px;">3</span>
                            </div>
                            <h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 0;">Add Items for Second Order</h3>
                        </div>
                        <div class="step-content">
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                                After your first order, add more items to cart:
                            </p>
                            <ul style="color: #666; font-size: 16px; line-height: 1.6; padding-left: 20px;">
                                <li>Click <strong>"Continue Shopping"</strong> on success page</li>
                                <li>Browse products in <strong>Collection</strong> page</li>
                                <li>Add different products to cart</li>
                                <li>Go to cart to review items</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #dc3545;">
                        <div class="step-header" style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div class="step-number" style="width: 50px; height: 50px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                <span style="color: #fff; font-weight: 900; font-size: 20px;">4</span>
                            </div>
                            <h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 0;">Place Your Second Order</h3>
                        </div>
                        <div class="step-content">
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                                Complete your second order:
                            </p>
                            <ul style="color: #666; font-size: 16px; line-height: 1.6; padding-left: 20px;">
                                <li>Go to <strong>Cart</strong> page again</li>
                                <li>Click <strong>"Proceed To Checkout"</strong></li>
                                <li>Fill out checkout form (can be different address)</li>
                                <li>Complete your second order</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="step-card" style="background: #fff; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); border-left: 5px solid #6f42c1;">
                        <div class="step-header" style="display: flex; align-items: center; margin-bottom: 20px;">
                            <div class="step-number" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                <span style="color: #fff; font-weight: 900; font-size: 20px;">5</span>
                            </div>
                            <h3 style="color: #333; font-size: 24px; font-weight: 700; margin-bottom: 0;">View All Your Orders</h3>
                        </div>
                        <div class="step-content">
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                                Track all your orders:
                            </p>
                            <ul style="color: #666; font-size: 16px; line-height: 1.6; padding-left: 20px;">
                                <li>Click <strong>"My Orders"</strong> in user menu</li>
                                <li>See all your order history</li>
                                <li>View order details and status</li>
                                <li>Track order progress</li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="guide-actions" style="text-align: center; margin-top: 50px;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('login') }}" 
                               style="display: block; background: #000; color: #FFD700; padding: 15px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #000;"
                               onmouseover="this.style.background='#FFD700'; this.style.color='#000'; this.style.borderColor='#000'"
                               onmouseout="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#000'">
                                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                                Login Now
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('collection') }}" 
                               style="display: block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); color: #000; padding: 15px 25px; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #FFD700;"
                               onmouseover="this.style.background='#000'; this.style.color='#FFD700'; this.style.borderColor='#FFD700'"
                               onmouseout="this.style.background='linear-gradient(135deg, #FFD700 0%, #FFA500 100%)'; this.style.color='#000'; this.style.borderColor='#FFD700'">
                                <i class="fas fa-shopping-bag" style="margin-right: 8px;"></i>
                                Shop Now
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('cart') }}" 
                               style="display: block; background: #28a745; color: #fff; padding: 15px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #28a745;"
                               onmouseover="this.style.background='#fff'; this.style.color='#28a745'; this.style.borderColor='#28a745'"
                               onmouseout="this.style.background='#28a745'; this.style.color='#fff'; this.style.borderColor='#28a745'">
                                <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                                View Cart
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
