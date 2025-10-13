@extends('layouts.app')

@section('title', 'Write a Review')

@section('content')

<!--=========================-->
<!--=   Review Form Area     =-->
<!--=========================-->

<section class="review-form-area padding-top-80 padding-bottom-80" style="background-color: #f8f9fa;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="review-form-container" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
					
					<!-- Form Header -->
					<div class="form-header text-center mb-5">
						<h2 style="color: #1b1b18; font-weight: 700; margin-bottom: 10px;">
							Write a review for 
							<select id="productSelect" style="border: none; background: transparent; color: #f53003; font-weight: 700; font-size: inherit; cursor: pointer; outline: none;">
								<option value="ali">Ali</option>
								<option value="product1">Product 1</option>
								<option value="product2">Product 2</option>
								<option value="product3">Product 3</option>
								<option value="custom">Custom Product</option>
							</select>
						</h2>
						<p style="color: #666; font-size: 16px;">Share your experience with other customers</p>
						
						<!-- Product Info Display -->
						<div id="productInfo" class="product-info-display mt-3" style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #f53003;">
							<div class="row align-items-center">
								<div class="col-md-2">
									<img id="productImage" src="{{ asset('media/images/product/s1.jpg') }}" alt="Product" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
								</div>
								<div class="col-md-10">
									<h6 id="productName" style="margin: 0; color: #1b1b18; font-weight: 600;">Ali - Premium Product</h6>
									<p id="productDescription" style="margin: 0; color: #666; font-size: 14px;">High-quality product with excellent features</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Review Form -->
					<form id="reviewForm" method="POST" action="#">
						@csrf
						
						<!-- Overall Rating -->
						<div class="form-group mb-4">
							<label for="rating" style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; display: block;">
								Overall rating <span style="color: #f53003;">*</span>
							</label>
							<div class="star-rating" style="display: flex; align-items: center;">
								<div class="stars" style="display: flex; gap: 5px;">
									<i class="fas fa-star star" data-rating="1" style="font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s;"></i>
									<i class="fas fa-star star" data-rating="2" style="font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s;"></i>
									<i class="fas fa-star star" data-rating="3" style="font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s;"></i>
									<i class="fas fa-star star" data-rating="4" style="font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s;"></i>
									<i class="fas fa-star star" data-rating="5" style="font-size: 24px; color: #ddd; cursor: pointer; transition: color 0.2s;"></i>
								</div>
								<input type="hidden" id="rating" name="rating" value="0" required>
								<span id="rating-text" style="margin-left: 15px; color: #666; font-weight: 500;"></span>
							</div>
						</div>

						<!-- Review Title -->
						<div class="form-group mb-4">
							<div style="display: flex; align-items: center; margin-bottom: 10px;">
								<label for="title" style="color: #1b1b18; font-weight: 600; margin: 0;">Title of your review</label>
								<span style="background: #e9ecef; color: #6c757d; padding: 2px 8px; border-radius: 12px; font-size: 12px; margin-left: 10px;">Optional</span>
							</div>
							<input type="text" 
								   id="title" 
								   name="title" 
								   class="form-control" 
								   placeholder="If you could say it in one sentence, what would you say?"
								   style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 16px; transition: border-color 0.3s;">
						</div>

						<!-- Review Content -->
						<div class="form-group mb-4">
							<label for="review" style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; display: block;">
								Your review <span style="color: #f53003;">*</span>
							</label>
							<textarea id="review" 
									  name="review" 
									  class="form-control" 
									  rows="6" 
									  maxlength="2000"
									  placeholder="Write your review to help others learn about this product"
									  required
									  style="border: 2px solid #e9ecef; border-radius: 8px; padding: 15px; font-size: 16px; resize: vertical; transition: border-color 0.3s;"></textarea>
							<div class="character-count" style="text-align: right; margin-top: 5px;">
								<span id="charCount" style="color: #666; font-size: 14px;">0/2000 characters</span>
							</div>
						</div>

						<!-- Terms and Conditions -->
						<div class="form-group mb-4">
							<div class="form-check">
								<input type="checkbox" 
									   class="form-check-input" 
									   id="terms" 
									   name="terms" 
									   required
									   style="transform: scale(1.2);">
								<label class="form-check-label" for="terms" style="color: #1b1b18; font-size: 16px; margin-left: 10px;">
									I agree to the <a href="#" style="color: #007bff; text-decoration: none;">Terms and Conditions</a> and <a href="#" style="color: #007bff; text-decoration: none;">Privacy Policy</a>
								</label>
							</div>
						</div>

						<!-- Security Verification -->
						<div class="form-group mb-4">
							<label style="color: #1b1b18; font-weight: 600; margin-bottom: 10px; display: block;">
								Security Verification <span style="color: #f53003;">*</span>
							</label>
							<div class="recaptcha-container" style="background: #f8f9fa; border: 2px solid #e9ecef; border-radius: 8px; padding: 20px; text-align: center;">
								<div class="recaptcha-widget" style="display: inline-flex; align-items: center; background: white; border: 1px solid #ddd; border-radius: 4px; padding: 10px 15px; cursor: pointer; transition: all 0.3s;">
									<input type="checkbox" id="recaptcha" name="recaptcha" style="margin-right: 10px; transform: scale(1.2);">
									<span style="color: #1b1b18; font-weight: 500;">I'm not a robot</span>
									<div style="margin-left: 10px; display: flex; align-items: center;">
										<div style="width: 20px; height: 20px; background: linear-gradient(45deg, #4285f4, #ea4335); border-radius: 50%; margin-right: 5px;"></div>
										<span style="font-size: 12px; color: #666;">reCAPTCHA</span>
									</div>
								</div>
								<div style="margin-top: 10px; font-size: 12px; color: #666;">
									<a href="#" style="color: #007bff; text-decoration: none;">Privacy</a> - <a href="#" style="color: #007bff; text-decoration: none;">Terms</a>
								</div>
								<div style="margin-top: 5px; font-size: 11px; color: #999;">
									reCAPTCHA Site Key: 6LdyCtwrAAAAAGMGHpw50sy0xMBye7lIDp7BLvsY
								</div>
							</div>
						</div>

						<!-- Submit Button -->
						<div class="form-group text-center">
							<button type="submit" 
									id="submitBtn"
									class="btn btn-primary btn-lg" 
									style="background: #007bff; border: none; padding: 15px 40px; font-size: 18px; font-weight: 600; border-radius: 8px; transition: all 0.3s; box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);">
								Submit review
							</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('styles')
<style>
	/* Form Focus States */
	.form-control:focus {
		border-color: #f53003 !important;
		box-shadow: 0 0 0 0.2rem rgba(245, 48, 3, 0.25) !important;
	}

	/* Star Rating Hover Effects */
	.star:hover,
	.star.active {
		color: #ffc107 !important;
	}

	/* Mini Star Rating Styles */
	.mini-star {
		font-size: 16px;
		color: #ddd;
		cursor: pointer;
		transition: all 0.2s ease;
		margin-right: 3px;
	}
	.mini-star:hover,
	.mini-star.active {
		color: #ffc107 !important;
		transform: scale(1.1);
	}

	/* Product Select Dropdown */
	#productSelect {
		appearance: none;
		background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
		background-repeat: no-repeat;
		background-position: right 8px center;
		background-size: 16px;
		padding-right: 30px;
	}

	/* Product Info Display */
	.product-info-display {
		animation: slideDown 0.3s ease;
	}

	@keyframes slideDown {
		from {
			opacity: 0;
			transform: translateY(-10px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Additional Options */
	.additional-options {
		animation: slideUp 0.4s ease;
	}

	@keyframes slideUp {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Recommend Options */
	.recommend-options label {
		transition: all 0.2s ease;
		padding: 8px 12px;
		border-radius: 6px;
		border: 2px solid transparent;
	}
	.recommend-options label:hover {
		background-color: rgba(0,0,0,0.05);
	}
	.recommend-options input[type="radio"]:checked + span {
		font-weight: 700;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.recommend-options {
			flex-direction: column;
			gap: 10px !important;
		}
		.recommend-options label {
			justify-content: center;
			text-align: center;
		}
		.additional-options .row .col-md-6 {
			margin-bottom: 15px;
		}
	}

	/* Recaptcha Widget Hover */
	.recaptcha-widget:hover {
		border-color: #007bff !important;
		box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
	}

	/* Submit Button Hover */
	#submitBtn:hover {
		background: #0056b3 !important;
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4) !important;
	}

	/* Form Validation Styles */
	.form-control.is-invalid {
		border-color: #dc3545 !important;
	}

	.form-control.is-valid {
		border-color: #28a745 !important;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.review-form-container {
			padding: 20px !important;
		}
		
		.form-header h2 {
			font-size: 24px !important;
		}
		
		.stars {
			justify-content: center;
		}
	}
</style>
@endpush

@push('scripts')
<script>
	$(document).ready(function() {
		let currentRating = 0;
		let detailedRatings = {
			quality: 0,
			value: 0,
			shipping: 0,
			service: 0
		};

		// Product data for different products
		const productData = {
			ali: {
				name: "Ali - Premium Product",
				description: "High-quality product with excellent features",
				image: "{{ asset('media/images/product/s1.jpg') }}"
			},
			product1: {
				name: "Product 1 - Advanced Model",
				description: "Latest model with cutting-edge technology",
				image: "{{ asset('media/images/product/s2.jpg') }}"
			},
			product2: {
				name: "Product 2 - Classic Edition",
				description: "Timeless design with modern functionality",
				image: "{{ asset('media/images/product/s3.jpg') }}"
			},
			product3: {
				name: "Product 3 - Professional Series",
				description: "Built for professionals who demand excellence",
				image: "{{ asset('media/images/product/s4.jpg') }}"
			},
			custom: {
				name: "Custom Product",
				description: "Tell us about your custom product experience",
				image: "{{ asset('media/images/product/s5.jpg') }}"
			}
		};

		// Product Selection Functionality
		$('#productSelect').on('change', function() {
			const selectedProduct = $(this).val();
			const product = productData[selectedProduct];
			
			if (product) {
				$('#productName').text(product.name);
				$('#productDescription').text(product.description);
				$('#productImage').attr('src', product.image);
			}
		});

		// Star Rating Functionality
		$('.star').on('click', function() {
			const rating = $(this).data('rating');
			currentRating = rating;
			$('#rating').val(rating);
			
			// Update stars
			$('.star').each(function(index) {
				if (index < rating) {
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
				}
			});

			// Update rating text
			const ratingTexts = ['', '', 'Poor', 'Fair', 'Good', 'Excellent'];
			$('#rating-text').text(ratingTexts[rating]);
		});

		// Star Hover Effects
		$('.star').on('mouseenter', function() {
			const rating = $(this).data('rating');
			$('.star').each(function(index) {
				if (index < rating) {
					$(this).css('color', '#ffc107');
				} else {
					$(this).css('color', '#ddd');
				}
			});
		});

		$('.stars').on('mouseleave', function() {
			$('.star').each(function(index) {
				if (index < currentRating) {
					$(this).css('color', '#ffc107');
				} else {
					$(this).css('color', '#ddd');
				}
			});
		});

		// Mini Star Rating Functionality
		$('.mini-star').on('click', function() {
			const category = $(this).data('category');
			const rating = $(this).data('rating');
			detailedRatings[category] = rating;
			
			// Update stars for this category
			$(this).siblings('.mini-star').each(function() {
				const starRating = $(this).data('rating');
				if (starRating <= rating) {
					$(this).addClass('active');
				} else {
					$(this).removeClass('active');
				}
			});
			
			// Auto-update overall rating based on detailed ratings
			updateOverallRating();
		});

		// Mini Star Hover Effects
		$('.mini-star').on('mouseenter', function() {
			const category = $(this).data('category');
			const rating = $(this).data('rating');
			
			$(this).siblings('.mini-star').each(function() {
				const starRating = $(this).data('rating');
				if (starRating <= rating) {
					$(this).css('color', '#ffc107');
				} else {
					$(this).css('color', '#ddd');
				}
			});
		});

		$('.mini-star').on('mouseleave', function() {
			$(this).siblings('.mini-star').each(function() {
				if ($(this).hasClass('active')) {
					$(this).css('color', '#ffc107');
				} else {
					$(this).css('color', '#ddd');
				}
			});
		});

		// Function to update overall rating based on detailed ratings
		function updateOverallRating() {
			const values = Object.values(detailedRatings);
			const average = values.reduce((sum, rating) => sum + rating, 0) / values.length;
			const roundedAverage = Math.round(average);
			
			if (roundedAverage > 0) {
				currentRating = roundedAverage;
				$('#rating').val(roundedAverage);
				
				// Update main stars
				$('.star').each(function(index) {
					if (index < roundedAverage) {
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
					}
				});
				
				const ratingTexts = ['', '', 'Poor', 'Fair', 'Good', 'Excellent'];
				$('#rating-text').text(ratingTexts[roundedAverage]);
			}
		}

		// Character Counter
		$('#review').on('input', function() {
			const length = $(this).val().length;
			$('#charCount').text(length + '/2000 characters');
			
			if (length > 1800) {
				$('#charCount').css('color', '#dc3545');
			} else if (length > 1500) {
				$('#charCount').css('color', '#ffc107');
			} else {
				$('#charCount').css('color', '#666');
			}
		});

		// Enhanced Form Validation and Submission
		$('#reviewForm').on('submit', function(e) {
			e.preventDefault();
			
			let isValid = true;
			let errorMessages = [];
			
			// Check rating
			if (currentRating === 0) {
				errorMessages.push('Please select a rating');
				isValid = false;
			}
			
			// Check review content
			if ($('#review').val().trim().length === 0) {
				errorMessages.push('Please write your review');
				isValid = false;
			}
			
			// Check terms
			if (!$('#terms').is(':checked')) {
				errorMessages.push('Please agree to the Terms and Conditions');
				isValid = false;
			}
			
			// Check recaptcha
			if (!$('#recaptcha').is(':checked')) {
				errorMessages.push('Please complete the security verification');
				isValid = false;
			}
			
			if (isValid) {
				// Collect all form data
				const formData = {
					product: $('#productSelect').val(),
					productName: productData[$('#productSelect').val()].name,
					rating: currentRating,
					detailedRatings: detailedRatings,
					title: $('#title').val(),
					review: $('#review').val(),
					purchaseDate: $('#purchaseDate').val(),
					usageDuration: $('#usageDuration').val(),
					recommend: $('input[name="recommend"]:checked').val(),
					pros: $('#pros').val(),
					cons: $('#cons').val(),
					termsAccepted: $('#terms').is(':checked'),
					submittedAt: new Date().toISOString()
				};
				
				// Show loading state
				const submitBtn = $('#submitBtn');
				const originalText = submitBtn.html();
				submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...').prop('disabled', true);
				
				// Simulate form submission (replace with actual AJAX call)
				setTimeout(function() {
					// Show detailed success message
					let successMessage = `Thank you for your review of ${formData.productName}!\n\n`;
					successMessage += `Rating: ${formData.rating}/5 stars\n`;
					successMessage += `Recommendation: ${formData.recommend || 'Not specified'}\n`;
					if (formData.usageDuration) {
						successMessage += `Usage Duration: ${formData.usageDuration.replace('-', ' ')}\n`;
					}
					successMessage += `\nYour feedback has been submitted successfully and will help other customers make informed decisions.`;
					
					alert(successMessage);
					
					// Reset form
					resetForm();
					
					// Clear saved draft
					localStorage.removeItem('reviewDraft');
					
					// Restore button
					submitBtn.html(originalText).prop('disabled', false);
				}, 2000);
			} else {
				// Show all error messages at once
				alert('Please fix the following issues:\n\n• ' + errorMessages.join('\n• '));
			}
		});

		// Function to reset the entire form
		function resetForm() {
			$('#reviewForm')[0].reset();
			currentRating = 0;
			$('.star').removeClass('active');
			$('#rating-text').text('');
			$('#charCount').text('0/2000 characters');
			
			// Reset detailed ratings
			detailedRatings = { quality: 0, value: 0, shipping: 0, service: 0 };
			$('.mini-star').removeClass('active');
			
			// Reset product selection
			$('#productSelect').val('ali').trigger('change');
		}

		// Auto-save functionality
		function autoSave() {
			const formData = {
				product: $('#productSelect').val(),
				rating: currentRating,
				title: $('#title').val(),
				review: $('#review').val(),
				timestamp: new Date().toISOString()
			};
			
			// Save to localStorage
			localStorage.setItem('reviewDraft', JSON.stringify(formData));
		}

		// Auto-save every 30 seconds
		setInterval(autoSave, 30000);

		// Form field focus effects
		$('.form-control').on('focus', function() {
			$(this).parent().addClass('focused');
		}).on('blur', function() {
			$(this).parent().removeClass('focused');
		});
	});
</script>
@endpush
