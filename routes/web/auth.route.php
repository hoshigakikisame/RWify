<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuth\GoogleOAuthController;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => 'guest'
], function () {
    Route::get('signin', [AuthController::class, 'signinPage'])->name('signInPage');
    Route::post('signin', [AuthController::class, 'signIn'])->name('signIn');

    // OAuths
    // Google  
    Route::group([
        'prefix' => 'google',
        'as' => 'google.'
    ], function () {
        Route::get('', [GoogleOAuthController::class, 'index'])->name('index');
        Route::get('callback', [GoogleOAuthController::class, 'callback'])->name('callback');
    });


    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

    Route::get('signout', [AuthController::class, 'signOut'])->name('signOut')->withoutMiddleware('guest')->middleware('auth');
});