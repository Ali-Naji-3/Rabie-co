<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
        // Share cart data with all views
        View::composer('*', function ($view) {
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

            $view->with([
                'globalCartItems' => $cartItems,
                'globalCartCount' => $cartCount,
                'globalCartTotal' => $cartTotal
            ]);
        });
    }
}
