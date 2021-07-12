<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/admin/home', [HomeController::class, 'index']);
Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');

Route::resource('admin/products', ProductController::class);
Route::resource('admin/category', CategoryController::class);
