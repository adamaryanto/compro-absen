<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AppearanceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

        Route::get('konten', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('konten', [SettingController::class, 'update'])->name('settings.update');

        Route::get('tampilan', [AppearanceController::class, 'edit'])->name('appearance.edit');
        Route::post('tampilan', [AppearanceController::class, 'update'])->name('appearance.update');

        Route::get('akun', [AccountController::class, 'edit'])->name('account.edit');
        Route::post('akun', [AccountController::class, 'update'])->name('account.update');

        Route::get('{type}', [CollectionController::class, 'index'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->name('collection.index');
        Route::get('{type}/create', [CollectionController::class, 'create'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->name('collection.create');
        Route::post('{type}', [CollectionController::class, 'store'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->name('collection.store');
        Route::get('{type}/{id}/edit', [CollectionController::class, 'edit'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->whereNumber('id')
            ->name('collection.edit');
        Route::match(['post', 'put', 'patch'], '{type}/{id}', [CollectionController::class, 'update'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->whereNumber('id')
            ->name('collection.update');
        Route::delete('{type}/{id}', [CollectionController::class, 'destroy'])
            ->whereIn('type', array_keys(config('compro.collections')))
            ->whereNumber('id')
            ->name('collection.destroy');
    });
});
