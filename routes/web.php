<?php

use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::match(['put', 'patch'], '/tips/{tip}', [TipController::class, 'update'])
    ->name('tips.update');
