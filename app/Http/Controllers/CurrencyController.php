<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function set(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|in:USD,EGP',
        ]);

        session(['currency' => $validated['currency']]);

        return redirect()->back();
    }
}
