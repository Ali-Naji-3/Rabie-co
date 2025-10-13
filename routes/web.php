<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/collection', function () {
    return view('Collection');
})->name('collection');

Route::get('/product', function () {
    return view('product-fullwidth');
})->name('product');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');
