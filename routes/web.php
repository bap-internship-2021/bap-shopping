<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
    return view('layouts.master');
    } else{
    return redirect()->route('login');
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.master');
})->name('dashboard');

Route::get('/admin/home', [HomeController::class, 'index']);
Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');

Route::resource('admin/products', ProductController::class);
Route::resource('admin/category', CategoryController::class);