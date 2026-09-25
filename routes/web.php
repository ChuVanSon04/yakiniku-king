<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TipController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
        // Login
        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.submit');

        // Khu vực cần đăng nhập
        Route::middleware('auth')->group(function () {

            Route::prefix('menu')->name('menu.')->group(function () {
                Route::resource('categories', MenuCategoryController::class)
                    ->except(['show']);

                Route::resource('items', MenuItemController::class)
                    ->except(['show']);

                Route::resource('combos', ComboController::class)
                    ->except(['show']);

                Route::resource('banners', BannerController::class)
                    ->except(['show']);

                Route::resource('promotions', PromotionController::class)
                    ->except(['show']);

                Route::resource('recipes', RecipeController::class)
                    ->except(['show']);

                Route::resource('tips', TipController::class)
                    ->except(['show']);

                Route::resource('restaurants', RestaurantController::class)
                    ->except(['show']);

                Route::resource('bookings', BookingController::class)
                    ->except(['show']);

                Route::resource('leads', LeadController::class)
                    ->except(['show']);

                Route::get('settings', [SettingController::class, 'index'])
                    ->name('settings.index');
                Route::match(['post', 'put', 'patch'], 'settings', [SettingController::class, 'update'])
                    ->name('settings.update');
            });

            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');
        });
    });
