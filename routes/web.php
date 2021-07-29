<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Order\OrderController;


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
        return view('home.home-page');
    } else {
        return redirect()->route('login');
    }
})->name('/');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('/');
})->name('dashboard');

Route::namespace('Product')->group(function () {
    Route::get('categories/{category}/products', [ProductController::class, 'index'])->name('categories.products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('user.products.show');
});

Route::middleware(['auth', 'is.user'])->namespace('Cart')->group(function () {
    Route::get('checkout/cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('checkout/shipping', [CartController::class, 'changeAddressShipped'])->name('carts.changeShipping');
    Route::post('carts', [CartController::class, 'store']); // API store item to cart
    Route::delete('carts/item', [CartController::class, 'destroyItemInCart'])->name('carts.item.destroy'); // Delete item in cart
    Route::delete('carts', [CartController::class, 'destroy'])->name('carts.destroy'); // Delete cart
});

Route::middleware('auth')->group(function () {
    Route::post('orders/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::resource('orders', OrderController::class);
    Route::get('orders/{id}/order-details', [\App\Http\Controllers\Order\OrderDetailController::class, 'getOrderDetail'])->name('orders.oderDetails.index');
});

