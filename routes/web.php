<?php

use App\Http\Controllers\Admin\HomeController;
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

Route::get('/home/admin', [HomeController::class, 'index']);
