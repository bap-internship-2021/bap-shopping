<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SpecificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Error\ErrorController;

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('profile-update/{id}', [ProfileController::class, 'handleUpdateProfile'])->name('profile.update');
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::post('search-products', [SearchController::class, 'search'])->name('search.product');
    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('specification', SpecificationController::class);
    Route::resource('voucher', VoucherController::class);
});

Route::get('404', [ErrorController::class, 'errorPage']);
