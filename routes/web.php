<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');
Route::view('/products', 'dashboard.products.index')->name('products.index');
   