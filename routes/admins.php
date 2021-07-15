<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SaleController;


Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('sale', SaleController::class);
});
