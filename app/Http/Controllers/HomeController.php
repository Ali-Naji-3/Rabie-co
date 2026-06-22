<?php

namespace App\Http\Controllers;

use App\Models\FaqSection;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\Review;
use App\Models\HeroSlider;
use App\Models\SiteSetting;
use App\Models\FeatureIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Get site settings
        $siteSettings = SiteSetting::getSettings();

        // Get hero sliders
        $heroSliders = Cache::remember('home:hero_sliders', 1800, function () {
            return HeroSlider::active()->ordered()->get();
        });

        // Short TTL because cards use scheduled() (start_date/end_date) — a longer
        // cache would keep showing an expired card past its end_date.
        $homepageSections = Cache::remember('home:sections', 300, function () {
            return HomepageSection::active()->ordered()
                ->with(['cards' => fn ($q) => $q->active()->scheduled()->ordered()])
                ->get()
                ->groupBy('position');
        });

        // Get feature icons
        $featureIcons = Cache::remember('home:feature_icons', 1800, function () {
            return FeatureIcon::active()->ordered()->get();
        });

        // Existing data
        $featuredProducts = Cache::remember('products:featured', 1800, function () {
            return Product::where('is_active', true)
                ->where('is_featured', true)
                ->with('category')
                ->withAvg(['reviews as avg_rating' => fn($q) => $q->where('is_approved', true)], 'rating')
                ->withCount(['reviews as approved_review_count' => fn($q) => $q->where('is_approved', true)])
                ->latest()
                ->take(8)
                ->get();
        });

        $categories = Cache::remember('categories:active_with_counts', 1800, function () {
            return Category::where('is_active', true)
                ->withCount('products')
                ->get();
        });

        $featuredReviews = Cache::remember('reviews:featured', 1800, function () {
            return Review::where('is_featured', true)
                ->where('is_approved', true)
                ->with(['user', 'product'])
                ->latest()
                ->take(6)
                ->get();
        });

        $faqSection = Cache::remember('home:faq', 1800, function () {
            return FaqSection::active()
                ->with(['items' => fn ($q) => $q->active()->ordered()])
                ->first();
        });

        return view('welcome', compact(
            'siteSettings',
            'heroSliders',
            'homepageSections',
            'featureIcons',
            'featuredProducts',
            'categories',
            'featuredReviews',
            'faqSection'
        ));
    }
}
