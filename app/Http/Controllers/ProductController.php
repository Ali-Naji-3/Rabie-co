<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('category', 'reviews');

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
        $categories = Category::where('is_active', true)->get();

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

        $products = Product::where('is_active', true)
            ->where(function ($query) use ($term) {
                $query->where('name', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%');
            })
            ->select('id', 'name', 'slug', 'price', 'sale_price', 'discount_percentage', 'primary_image')
            ->take(6)
            ->get()
            ->map(function (Product $product) {
                return [
                    'name' => $product->name,
                    'url' => route('product.show', $product->slug),
                    'image' => $product->primary_image
                        ? asset('storage/' . $product->primary_image)
                        : asset('media/images/product/sp1.jpg'),
                    'price' => number_format((float) $product->final_price, 2),
                ];
            });

        return response()->json($products);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'reviews.user'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('product-fullwidth', compact('product', 'relatedProducts'));
    }
}
