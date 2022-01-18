<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithrawController;
use App\Models\Transaction;
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

    Route::middleware(['admin'])->group(function(){
        Route::resource('users', UserController::class)->only('index', 'destroy');
    });

    Route::post('purchase', [TransactionController::class, 'purchase'])->name('purchase');

    Route::middleware(['seller'])->group(function(){
        Route::resource('products', ProductController::class)->except('show');
        Route::post('purchase-confirmation/{transaction:id}', [TransactionController::class, 'purchase_confirmation'])->name('purchase.confirmation');
    });

    Route::middleware(['officer'])->group(function(){
        Route::post('withdraw-confirmation/{transaction:id}', [WithrawController::class, 'confirm'])->name('withdraw.confirmation');
        Route::post('topup-confirmation/{transaction:id}', [TransactionController::class, 'topup_confirmation'])->name('topup.confirmation');
        Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
    });

    Route::middleware(['not_student'])->group(function(){
        Route::view('/dashboard', 'dashboard')->name('dashboard');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::post('transactions/{transaction:id}/deny', [TransactionController::class, 'deny'])->name('transactions.deny');
        Route::resource('transactions', TransactionController::class)->only('index');
    });

    Route::post('withdraw', [WithrawController::class, 'store'])->name('withdraw');
    Route::post('topup', [TransactionController::class, 'topup'])->name('topup');
});
