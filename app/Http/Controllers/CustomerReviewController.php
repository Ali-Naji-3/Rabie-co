<?php

namespace App\Http\Controllers;

use App\Models\CustomerReview;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    /**
     * Store a public homepage review submission.
     *
     * Forced server-side: status=pending, is_pinned=false, sort_order=0 — these
     * are never read from the request, so a crafted POST cannot self-approve,
     * self-pin, or jump the queue. Only validated content fields are persisted.
     */
    public function store(Request $request, ImageOptimizationService $optimizer)
    {
        // Honeypot: real users leave this blank. Bots that fill it get a silent
        // success (no row created, no signal to the bot).
        if (filled($request->input('website'))) {
            return redirect()->back()->with('success', 'Thank you! Your review has been submitted for approval.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'rating' => 'required|integer|between:1,5',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Re-encodes through Intervention — strips EXIF / neutralizes polyglots.
            $imagePath = $optimizer->optimizeAndStore($request->file('image'), 'customer-reviews');
        }

        CustomerReview::create([
            'customer_name' => $validated['customer_name'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'rating' => $validated['rating'],
            'image' => $imagePath,
            'status' => CustomerReview::STATUS_PENDING,
            'is_pinned' => false,
            'sort_order' => 0,
        ]);

        return redirect()->back()->with('success', 'Thank you! Your review has been submitted for approval.');
    }
}
