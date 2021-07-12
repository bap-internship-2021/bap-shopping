<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Cart\CartController;

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
    } else {
        return redirect()->route('login');
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.master');
})->name('dashboard');


Route::namespace('Product')->group(function () {
    Route::get('products', [ProductController::class, 'listAllProducts'])->name('products.index'); // >> list all Products
    Route::get('products/{product}', [ProductController::class, 'detailProductInfo'])->name('products.detail');
});

Route::namespace('Cart')->group(function () {
    Route::get('carts/item', [CartController::class, 'listItemInCart'])->name('carts.item');
    Route::post('carts', [CartController::class, 'addProductToCart']);
    Route::post('carts/destroy', [CartController::class, 'deleteAllItemCart'])->name('carts.destroy.all');
});

