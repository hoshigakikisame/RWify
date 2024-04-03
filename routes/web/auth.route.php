<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => 'guest'
], function() {
    Route::get('signin', [AuthController::class, 'signinPage'])->name('signInPage');
    Route::post('signin', [AuthController::class, 'signIn'])->name('signIn');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    
    Route::get('signout', [AuthController::class, 'signOut'])->name('signOut')->withoutMiddleware('guest')->middleware('auth');
});