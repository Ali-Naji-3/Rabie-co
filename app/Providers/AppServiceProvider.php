<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\SiteSetting;
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
        
        // Share cart data and site settings with all views
        View::composer('*', function ($view) {
            // Cart data
            $cartItems = collect();
            $cartCount = 0;
            $cartTotal = 0;

            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get();
            } else {
                if (session()->has('_token')) {
                    $sessionId = session()->getId();
                    $cartItems = Cart::where('session_id', $sessionId)
                        ->with('product')
                        ->get();
                }
            }

            $cartCount = $cartItems->sum('quantity');
            $cartTotal = $cartItems->sum(function($item) {
                return $item->product->final_price * $item->quantity;
            });

            // Site settings (cached for 1 hour)
            $siteSettings = Cache::remember('site_settings', 3600, function () {
                return SiteSetting::first() ?? new SiteSetting();
            });

            $view->with([
                'globalCartItems' => $cartItems,
                'globalCartCount' => $cartCount,
                'globalCartTotal' => $cartTotal,
                'siteSettings' => $siteSettings
            ]);
        });
    }
}
