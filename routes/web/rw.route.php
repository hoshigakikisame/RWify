<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RW\RWController;
use App\Http\Controllers\RW\Manage\ManageWargaController;

// rw routes
Route::group([
    'prefix' => 'rw',
    'as' => 'rw.',
    'middleware' => ['auth', 'hasRole:Ketua Rukun Warga']
], function() {
    Route::get('dashboard', [RWController::class, 'dashboard'])->name('dashboard');
    
    Route::group([
        'prefix' => 'manage',
        'as' => 'manage.'
    ], function() {
        Route::get('warga', [ManageWargaController::class, 'manageWargaPage'])->name('warga');
    });
});

// rw manage routes
