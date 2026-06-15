<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function multipleOrdersGuide()
    {
        return view('multiple-orders-guide');
    }

    public function dashboard()
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            }
            return redirect('/')->with('info', 'Welcome back, ' . auth()->user()->name . '!');
        }
        return redirect()->route('login');
    }

    public function writeReview()
    {
        return view('write-review');
    }
}
