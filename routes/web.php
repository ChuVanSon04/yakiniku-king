<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

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

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');
    });
});