<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('welcome', compact('featuredProducts', 'categories', 'featuredReviews'));
    }
}
