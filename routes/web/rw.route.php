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
    
    // rw manage routes
    Route::group([
        'prefix' => 'manage',
        'as' => 'manage.'
    ], function() {
        Route::get('warga', [ManageWargaController::class, 'manageWargaPage'])->name('warga');
        Route::post('warga/new', [ManageWargaController::class, 'addNewWarga'])->name('warga.new');
        Route::post('warga/update', [ManageWargaController::class, 'updateWarga'])->name('warga.update');
        Route::post('warga/delete', [ManageWargaController::class, 'deleteWarga'])->name('warga.delete');
    });
});

