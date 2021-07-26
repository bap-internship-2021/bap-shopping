<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Voucher\VoucherController;

Route::namespace('Voucher')->group(function () {
    Route::get('vouchers', [VoucherController::class, 'index'])->name('user.vouchers.index'); // Get all voucher
});
