<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($product)
    {
        $product = Product::findOrFail($product);
        return view('write-review', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed this product (allow multiple reviews but show warning)
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        $warningMessage = '';
        if ($existingReview) {
            $warningMessage = ' You have already reviewed this product before.';
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'is_approved' => false, // Admin must approve
        ]);

        return redirect()->route('product.show', Product::find($request->product_id)->slug)
            ->with('success', 'Thank you for your review! It will be published after approval.' . $warningMessage);
    }
}
