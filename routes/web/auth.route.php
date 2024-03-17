<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
], function() {
    Route::get('login', [AuthController::class, 'loginForm'])
        ->name('loginForm');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});