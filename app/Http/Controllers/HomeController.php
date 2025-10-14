<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\HeroSlider;
use App\Models\PromotionalBanner;
use App\Models\SiteSetting;
use App\Models\FeatureIcon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get site settings
        $siteSettings = SiteSetting::getSettings();
        
        // Get hero sliders
        $heroSliders = HeroSlider::active()
            ->ordered()
            ->get();
        
        // Get promotional banners for "after_products" position
        $promoBannersAfterProducts = PromotionalBanner::active()
            ->scheduled()
            ->byPosition('after_products')
            ->ordered()
            ->get();
        
        // Get promotional banners for "after_reviews" position
        $promoBannersAfterReviews = PromotionalBanner::active()
            ->scheduled()
            ->byPosition('after_reviews')
            ->ordered()
            ->get();
        
        // Get feature icons
        $featureIcons = FeatureIcon::active()
            ->ordered()
            ->get();
        
        // Existing data
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        $featuredReviews = Review::where('is_featured', true)
            ->where('is_approved', true)
            ->with(['user', 'product'])
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'siteSettings',
            'heroSliders',
            'promoBannersAfterProducts',
            'promoBannersAfterReviews',
            'featureIcons',
            'featuredProducts',
            'categories',
            'featuredReviews'
        ));
    }
}
