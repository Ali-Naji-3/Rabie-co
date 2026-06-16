<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\Category;
use App\Models\FeatureIcon;
use App\Models\HeroSlider;
use App\Models\Product;
use App\Models\PromotionalBanner;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Observers\CategoryObserver;
use App\Observers\FeatureIconObserver;
use App\Observers\HeroSliderObserver;
use App\Observers\ProductObserver;
use App\Observers\PromotionalBannerObserver;
use App\Observers\ReviewObserver;
use App\Observers\SiteSettingObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        SiteSetting::observe(SiteSettingObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        HeroSlider::observe(HeroSliderObserver::class);
        PromotionalBanner::observe(PromotionalBannerObserver::class);
        FeatureIcon::observe(FeatureIconObserver::class);
        Review::observe(ReviewObserver::class);

        // Share cart data and site settings with all views
        View::composer('*', function ($view) {
            // Site settings (cached for 1 hour) — shared everywhere
            $siteSettings = Cache::remember('site_settings', 3600, function () {
                return SiteSetting::first() ?? new SiteSetting();
            });

            // Always inject defaults so layout variables are never undefined,
            // including during feature tests and console-run commands.
            $cartItems = collect();
            $cartCount = 0;
            $cartTotal = 0;

            // Cart DB queries are storefront-only — skip on every Filament component render.
            if (! (request()->is('admin') || request()->is('admin/*'))) {
                if (Auth::check()) {
                    $cartItems = Cart::where('user_id', Auth::id())
                        ->with('product')
                        ->get();
                } elseif (session()->has('_token')) {
                    $sessionId = session()->getId();
                    $cartItems = Cart::where('session_id', $sessionId)
                        ->with('product')
                        ->get();
                }

                $cartCount = $cartItems->sum('quantity');
                $cartTotal = $cartItems->sum(function ($item) {
                    return $item->product->final_price * $item->quantity;
                });
            }

            $view->with([
                'globalCartItems' => $cartItems,
                'globalCartCount' => $cartCount,
                'globalCartTotal' => $cartTotal,
                'siteSettings'    => $siteSettings,
            ]);
        });
    }
}
