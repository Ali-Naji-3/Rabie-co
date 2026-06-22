<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/multiple-orders-guide', [PageController::class, 'multipleOrdersGuide'])->name('multiple-orders-guide');

// Public homepage review submission (separate from Product Reviews /review*).
// Throttled against abuse; lands as pending for admin moderation.
Route::post('/customer-reviews', [CustomerReviewController::class, 'store'])
    ->name('customer-review.store')
    ->middleware('throttle:5,1');

// Products
Route::get('/collection', [ProductController::class, 'index'])->name('collection');
Route::get('/search-suggestions', [ProductController::class, 'suggestions'])->name('search.suggestions')->middleware('throttle:30,1');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->name('order.success');
    
    // Customer Orders
    Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:10,1');

// Currency switcher — no auth required (display preference only)
Route::post('/currency', [App\Http\Controllers\CurrencyController::class, 'set'])->name('currency.set');

// Dashboard - Redirect to Filament for admins
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Reviews
    Route::get('/write-review', [PageController::class, 'writeReview'])->name('write-review');
    Route::get('/review/create/{product}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});
