<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;

Route::prefix('admin')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('admin.login.submit');

    // Khu vực cần đăng nhập
    Route::middleware('auth')->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::prefix('menu')->name('admin.menu.')->group(function () {
            Route::resource('categories', MenuCategoryController::class)
                ->except(['show']);

            Route::resource('items', MenuItemController::class)
                ->except(['show']);
        });

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');
    });
});