<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RW\RWController;

// rw routes
Route::group([
    'prefix' => 'rw',
    'as' => 'rw.',
    'middleware' => ['auth', 'hasRole:ketua_rukun_warga']
], function() {
    Route::get('dashboard', [RWController::class, 'dashboard'])->name('dashboard');
});