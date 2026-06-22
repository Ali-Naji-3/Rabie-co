<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\Category;
use App\Models\FeatureIcon;
use App\Models\HeroSlider;
use App\Models\Product;
use App\Models\HomepageSection;
use App\Models\PromotionalBanner;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Observers\CategoryObserver;
use App\Observers\FeatureIconObserver;
use App\Observers\HeroSliderObserver;
use App\Observers\HomepageSectionObserver;
use App\Observers\ProductObserver;
use App\Observers\PromotionalBannerObserver;
use App\Observers\ReviewObserver;
use App\Observers\EgpRateHistoryObserver;
use App\Observers\SiteSettingObserver;
use App\Models\EgpRateHistory;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // `scoped` (not `singleton`): one instance per request/job, flushed at
        // the boundary. CurrencyService memoizes the EGP rate and default
        // currency on the instance, so scoping keeps that memo request-local
        // and prevents stale values leaking across requests/tests.
        $this->app->scoped(CurrencyService::class);

        // Resolve site settings at most once per request. Backs
        // SiteSetting::getSettings() so the view composer, CurrencyService and
        // controllers share a single cache lookup instead of one each.
        $this->app->scoped(SiteSetting::REQUEST_CACHE_KEY, function () {
            return Cache::remember('site_settings', 1800, function () {
                return SiteSetting::first() ?? new SiteSetting();
            });
        });

        // Resolve cart data + shared view variables once per request. The
        // wildcard composer below fires per view AND per partial, so without
        // this the cart query and settings lookup ran dozens of times per page.
        $this->app->scoped('storefront.view_globals', function () {
            $siteSettings = SiteSetting::getSettings();

            $cartItems = collect();
            $cartCount = 0;
            $cartTotal = 0;

            // Cart DB queries are storefront-only — skip on Filament renders.
            if (! (request()->is('admin') || request()->is('admin/*'))) {
                if (Auth::check()) {
                    $cartItems = Cart::where('user_id', Auth::id())
                        ->with('product')
                        ->get();
                } elseif (session()->has('_token')) {
                    $cartItems = Cart::where('session_id', session()->getId())
                        ->with('product')
                        ->get();
                }

                $cartCount = $cartItems->sum('quantity');
                $cartTotal = $cartItems->sum(function ($item) {
                    return $item->product->final_price * $item->quantity;
                });
            }

            return [
                'globalCartItems'  => $cartItems,
                'globalCartCount'  => $cartCount,
                'globalCartTotal'  => $cartTotal,
                'siteSettings'     => $siteSettings,
                'activeCurrency'   => session('currency', 'USD'),
                'currencyService'  => app(CurrencyService::class),
            ];
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        EgpRateHistory::observe(EgpRateHistoryObserver::class);
        SiteSetting::observe(SiteSettingObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        HeroSlider::observe(HeroSliderObserver::class);
        PromotionalBanner::observe(PromotionalBannerObserver::class);
        HomepageSection::observe(HomepageSectionObserver::class);
        FeatureIcon::observe(FeatureIconObserver::class);
        Review::observe(ReviewObserver::class);

        // @price($amount) — formats a USD amount in the session-selected currency.
        // This is the ONLY place in the codebase allowed to call CurrencyService::formatPrice().
        Blade::directive('price', function (string $expression) {
            return "<?php echo app(\App\Services\CurrencyService::class)->formatPrice((float)($expression)); ?>";
        });

        // Share cart data and site settings with all views. The heavy lifting
        // (cart query + settings lookup) is memoized in the request-scoped
        // 'storefront.view_globals' binding, so it runs once per request even
        // though this composer fires for every view and every @include partial.
        View::composer('*', function ($view) {
            $view->with(app('storefront.view_globals'));
        });
    }
}
