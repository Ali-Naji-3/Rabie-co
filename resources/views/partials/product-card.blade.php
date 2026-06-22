@php
    $settings = \App\Models\SiteSetting::getSettings();
@endphp

<div class="premium-card group" style="
    background: #fff !important;
    border: 1px solid #eee !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    height: 100% !important;
    width: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05) !important;
    position: relative !important;
    text-align: left !important;
    box-sizing: border-box !important;
">
    <!-- Image Area -->
    <div class="product-card-img-container" style="position: relative !important; aspect-ratio: 1/1 !important; background: #fafafa !important; display: flex !important; align-items: center !important; justify-content: center !important; overflow: hidden !important; padding: 12px !important;">
        <a href="{{ route('product.show', $product->slug) }}" style="width: 100% !important; height: 100% !important; display: flex !important; align-items: center !important; justify-content: center !important;">
            <img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : asset('media/images/product/1.jpg') }}" 
                 alt="{{ $product->name }}"
                 style="max-width: 100% !important; max-height: 100% !important; height: auto !important; width: auto !important; object-fit: contain !important; transition: transform 0.5s ease !important;"
                 class="group-hover:scale-105">
        </a>
        
        @if($product->stock === 0)
            <div style="position: absolute !important; top: 10px !important; left: 10px !important; background: #ef4444 !important; color: #fff !important; padding: 4px 8px !important; border-radius: 4px !important; font-size: 10px !important; font-weight: 700 !important; text-transform: uppercase !important; z-index: 10 !important;">Out of Stock</div>
        @elseif($product->discount_percentage > 0)
            <div style="position: absolute !important; top: 10px !important; left: 10px !important; background: #dc2626 !important; color: #fff !important; padding: 4px 8px !important; border-radius: 4px !important; font-size: 11px !important; font-weight: 700 !important; z-index: 10 !important;">{{ $product->discount_percentage }}% OFF</div>
        @endif
    </div>

    <!-- Info Area -->
    <div class="card-info-area" style="padding: 20px !important; flex-grow: 1 !important; display: flex !important; flex-direction: column !important; background: #fff !important; border: none !important;">
        
        <!-- Rating Row -->
        @if($product->display_rating !== null)
        <div style="display: flex !important; align-items: center !important; gap: 6px !important; margin-bottom: 10px !important; flex-wrap: wrap !important;">
            <div style="display: flex !important; gap: 2px !important; color: #fbbf24 !important; font-size: 11px !important;">
                @php
                    $full = (int) floor($product->display_rating);
                    $half = ($product->display_rating - $full) >= 0.5;
                @endphp
                @for($i = 0; $i < $full; $i++) <i class="fas fa-star"></i> @endfor
                @if($half) <i class="fas fa-star-half-alt"></i> @endif
                @for($i = 0; $i < (5 - $full - ($half ? 1 : 0)); $i++) <i class="far fa-star" style="color: #e5e7eb !important;"></i> @endfor
            </div>
            <span style="font-size: 12px !important; font-weight: 600 !important; color: #374151 !important;">{{ number_format($product->display_rating, 1) }}</span>
            <span style="color: #d1d5db !important; font-size: 11px !important;">|</span>
            <span style="font-size: 11px !important; color: #6b7280 !important;">{{ number_format($product->display_review_count) }}</span>
        </div>
        @endif

        <!-- Title -->
        <h3 style="margin: 0 0 8px !important; padding: 0 !important; border: none !important;">
            <a href="{{ route('product.show', $product->slug) }}" class="product-card-title hover:text-blue-600" style="
                font-size: 17px !important;
                font-weight: 700 !important;
                color: #111 !important;
                text-decoration: none !important;
                line-height: 1.3 !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2 !important;
                -webkit-box-orient: vertical !important;
                overflow: hidden !important;
                min-height: 2.6em !important;
                transition: color 0.2s !important;
            " onmouseover="this.style.color='#2563eb'" onmouseout="this.style.color='#111'">
                {{ $product->name }}
            </a>
        </h3>

        <!-- Short Description -->
        @if($product->short_description)
        <p style="
            font-size: 13px !important;
            color: #6b7280 !important;
            line-height: 1.5 !important;
            margin: 0 0 16px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-align: left !important;
        ">
            {{ $product->short_description }}
        </p>
        @endif

        <!-- Price Area -->
        <div style="margin-top: auto !important; padding-bottom: 16px !important;">
            @if($product->final_price < $product->price)
                <div style="color: #ef4444 !important; text-decoration: line-through !important; font-size: 14px !important; font-weight: 500 !important; opacity: 0.7 !important; margin-bottom: 2px !important;">
                    @price($product->price)
                </div>
                <div style="color: #16a34a !important; font-size: 20px !important; font-weight: 800 !important; line-height: 1 !important;">
                    @price($product->final_price)
                </div>
            @else
                <div style="color: #16a34a !important; font-size: 20px !important; font-weight: 800 !important;">
                    @price($product->final_price)
                </div>
            @endif
        </div>

        <!-- Buttons Area -->
        @if($settings->enable_product_card_ctas || $settings->enable_buy_now_button)
        <div style="display: flex !important; flex-direction: column !important; gap: 8px !important;">
            @if($product->stock === 0)
                <div style="width: 100% !important; padding: 10px !important; background: #f3f4f6 !important; color: #9ca3af !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; border-radius: 8px !important; text-align: center !important; border: 1px solid #e5e7eb !important;">Out of Stock</div>
            @else
                @if($settings->enable_product_card_ctas)
                <form action="{{ route('cart.add') }}" method="POST" style="margin: 0 !important;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" style="width: 100% !important; padding: 11px !important; background: #000 !important; color: #fff !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; border-radius: 8px !important; border: 1px solid #000 !important; cursor: pointer !important; transition: all 0.3s !important; display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important;" onmouseover="this.style.background='#fff';this.style.color='#000'" onmouseout="this.style.background='#000';this.style.color='#fff'">
                        <i class="fas fa-shopping-cart" style="font-size: 11px !important;"></i> Add To Cart
                    </button>
                </form>
                @endif

                @if($settings->enable_buy_now_button)
                <form action="{{ route('cart.add') }}" method="POST" style="margin: 0 !important;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="redirect" value="{{ route('checkout') }}">
                    <button type="submit" style="width: 100% !important; padding: 11px !important; background: #fff !important; color: #000 !important; font-size: 12px !important; font-weight: 700 !important; text-transform: uppercase !important; border-radius: 8px !important; border: 1px solid #d1d5db !important; cursor: pointer !important; transition: all 0.3s !important; display: flex !important; align-items: center !important; justify-content: center !important; gap: 6px !important;" onmouseover="this.style.borderColor='#000'" onmouseout="this.style.borderColor='#d1d5db'">
                        <i class="fas fa-bolt" style="font-size: 11px !important;"></i> Buy Now
                    </button>
                </form>
                @endif
            @endif
        </div>
        @endif
    </div>
</div>

<style>
    .premium-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        transform: translateY(-2px) !important;
    }
    /* Mobile Specific Overrides */
    @media (max-width: 480px) {
        .card-info-area {
            padding: 10px !important;
        }
        .product-card-title {
            font-size: 14px !important;
            min-height: 2.6em !important;
        }
        .product-card-img-container {
            padding: 6px !important;
        }
    }
</style>
