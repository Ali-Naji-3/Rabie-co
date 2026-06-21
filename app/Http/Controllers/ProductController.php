<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)
            ->with('category')
            ->withAvg(['reviews as avg_rating' => fn($q) => $q->where('is_approved', true)], 'rating')
            ->withCount(['reviews as approved_review_count' => fn($q) => $q->where('is_approved', true)]);

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->paginate(12);
        $categories = Cache::remember('categories:active', 1800, function () {
            return Category::where('is_active', true)->get();
        });

        return view('Collection', compact('products', 'categories'));
    }

    /**
     * Live search suggestions (JSON) for the header search box.
     */
    public function suggestions(Request $request)
    {
        $term = trim((string) $request->query('q', ''));

        if (mb_strlen($term) < 2) {
            return response()->json([]);
        }

        // Currency comes from session (page context) or explicit ?currency= param.
        // The param allows the JS caller to pass the current session currency so the
        // formatted price is consistent with the rest of the storefront.
        $requestedCurrency = $request->query('currency');
        $currency = in_array($requestedCurrency, CurrencyService::CURRENCIES, true)
            ? $requestedCurrency
            : session('currency', 'USD');

        $currencyService = app(CurrencyService::class);

        $products = Product::where('is_active', true)
            ->where(function ($query) use ($term) {
                $query->where('name', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%');
            })
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'discount_percentage', 'primary_image')
            ->take(6)
            ->get()
            ->map(function (Product $product) use ($currencyService, $currency) {
                return [
                    'name'  => $product->name,
                    'url'   => route('product.show', $product->slug),
                    'image' => $product->primary_image
                        ? asset('storage/' . $product->primary_image)
                        : asset('media/images/product/sp1.jpg'),
                    'price' => $currencyService->formatPrice((float) $product->final_price, $currency),
                ];
            });

        return response()->json($products);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',
                'reviews' => fn($q) => $q->where('is_approved', true)->orderBy('rating', 'desc')->latest()->take(5),
                'reviews.user',
            ])
            ->withAvg(['reviews as avg_rating' => fn($q) => $q->where('is_approved', true)], 'rating')
            ->withCount(['reviews as approved_review_count' => fn($q) => $q->where('is_approved', true)])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('product-fullwidth', compact('product', 'relatedProducts'));
    }
}
