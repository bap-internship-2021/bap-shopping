<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->middleware(['auth'])->group(function () {
    Route::get('profiles', [\App\Http\Controllers\User\Profile\ProfileController::class, 'show'])->name('profiles.show');
    Route::put('profiles', [\App\Http\Controllers\User\Profile\ProfileController::class, 'update'])->name('profiles.update');
});
