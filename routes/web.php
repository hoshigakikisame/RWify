<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Shared\SharedController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::get('test', [TestController::class, 'test'])
    ->name('test');

Route::get('', [SharedController::class, 'landing'])
    ->name('landing');

// require __DIR__.'/auth.php';
