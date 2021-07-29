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
//    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
//    Route::put('profile-update/{id}', [ProfileController::class, 'handleUpdateProfile'])->name('profile.update');
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::post('search-products', [SearchController::class, 'search'])->name('search.product');
    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('specification', SpecificationController::class);
    Route::resource('voucher', VoucherController::class);
    Route::get('orders/pending', [OrderController::class , 'listOrderPending'])->name('admin.orderpending');
    Route::get('orders/sending', [OrderController::class , 'listOrderSending'])->name('admin.ordersending');
    Route::get('orders/detail/{id}', [OrderController::class , 'detailOrder'])->name('admin.order.detail');
    Route::get('orders/pending/accept/{id}', [OrderController::class, 'acceptOrder'])->name('admin.order.accept');
});

Route::get('profile', [ProfileController::class, 'index'])->name('profiles.show');
Route::put('profile/{id}', [ProfileController::class, 'handleUpdateProfile'])->name('profiles.update');

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
