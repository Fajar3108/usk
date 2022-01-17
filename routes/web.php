<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::resource('users', UserController::class)->only('index', 'destroy');
    Route::resource('products', ProductController::class)->except('show');
    Route::post('topup-confirmation/{transaction:id}', [TransactionController::class, 'topup_confirmation'])->name('topup.confirmation');
    Route::resource('transactions', TransactionController::class)->only('index');

    // API
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('topup', [TransactionController::class, 'topup'])->name('topup');
});
