<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sale\SaleController;

Route::namespace('Sale')->group(function () {
    Route::get('sales', [SaleController::class, 'index'])->name('user.sales.index'); // Get all sales
});
