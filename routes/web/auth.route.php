<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
], function() {
    Route::get('signin', [AuthController::class, 'signinForm'])
        ->name('signinForm');
    Route::post('signin', [AuthController::class, 'signIn'])->name('signin');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('signin');
});