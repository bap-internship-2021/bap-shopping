<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Products\ProductController;

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



Route::namespace('Products')->group(function (){
    Route::get('products', [ProductController::class, 'listAllProducts'])->name('products.index'); // >> list all Products
    Route::get('products/{product}', [ProductController::class, 'detailProductInfo'])->name('products.detail');
});
