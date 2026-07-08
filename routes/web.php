<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ユーザー
Route::resource('products', ProductController::class)
    ->only(['index', 'show']);
Route::get('/cart', [CartController::class, 'store'])->name('cart.store');

//管理者
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        //ダッシュボード
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        //商品管理
        Route::resource('products', AdminProductController::class);
});

Route::middleware('auth')->group(function () {

    //プロフィール
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';