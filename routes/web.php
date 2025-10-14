<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Products
Route::get('/collection', [ProductController::class, 'index'])->name('collection');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard - Redirect to Filament for admins
Route::get('/dashboard', function() {
    if (auth()->check()) {
        // If admin, redirect to Filament
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        }
        // Regular users go to homepage (no separate dashboard)
        return redirect('/')->with('info', 'Welcome back, ' . auth()->user()->name . '!');
    }
    return redirect()->route('login');
})->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Reviews
    Route::get('/write-review', function () {
        return view('write-review');
    })->name('write-review');
    Route::get('/review/create/{product}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});
