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

    Route::get('forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('forgotPasswordPage');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    

    Route::get('signout', [AuthController::class, 'signOut'])->name('signOut')->withoutMiddleware('guest')->middleware('auth');
});

// special route for reset password
Route::get('auth/reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->middleware('guest')->name('password.reset');
Route::post('auth/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');
