<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SpecificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Error\ErrorController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware(['is.admin'])->prefix('admin')->group(function() {
    Route::get('home', [HomeController::class, 'index']);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard/product', [DashboardController::class, 'statisticalProduct'])->name('admin.statistical.product');
    Route::get('dashboard/product/{id}', [DashboardController::class, 'statisticalProductByCategory'])->name('admin.statistical.productByCategory');
    Route::get('dashboard/sale', [DashboardController::class, 'statisticalSale'])->name('admin.statistical.sale');
    Route::post('dashboard/sale/search-by-date', [DashboardController::class, 'searchSaleByDate'])->name('admin.searchByDate');
    Route::post('dashboard/sale/select-by-option', [DashboardController::class, 'selectByOption'])->name('admin.selectByOption');

    Route::get('profile', [ProfileController::class, 'index'])->name('profiles.show');
    Route::put('profile/{id}', [ProfileController::class, 'handleUpdateProfile'])->name('profiles.update');

    Route::resource('products', ProductController::class);

    Route::resource('category', CategoryController::class);

    Route::post('search-products', [SearchController::class, 'search'])->name('search.product');
    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::post('search-orders', [SearchController::class, 'searchOrder'])->name('search.order');
    Route::get('search-order-result', [SearchController::class, 'searchOrderResult'])->name('search.order.result');

    Route::get('users', [UserController::class, 'index'])->name('users');

    Route::resource('specification', SpecificationController::class);

    Route::resource('voucher', VoucherController::class);

    Route::get('orders/index', [OrderController::class, 'listAllOrder'])->name('admin.orders');
    Route::get('orders/status/{status}', [OrderController::class , 'listOrderByStatus'])->name('admin.order.status');
    Route::get('orders/detail/{status}', [OrderController::class , 'detailOrder'])->name('admin.order.detail');
    Route::get('orders/pending/accept/{id}', [OrderController::class, 'acceptOrder'])->name('admin.order.accept');
    Route::get('orders/pending/acceptall', [OrderController::class, 'acceptAllOrder'])->name('admin.order.acceptall');
    Route::get('orders/cancel/{id}', [OrderController::class, 'cancelOrderPage'])->name('admin.order.cancel');
    Route::post('orders/confirmcancel/{id}', [OrderController::class, 'cancelOrder'])->name('admin.order.confirmcancel');
    Route::get('order/sending/accept/{id}', [OrderController::class, 'finishOrder'])->name('admin.order.finish');
    
});



Route::get('404', [ErrorController::class, 'errorPage']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

