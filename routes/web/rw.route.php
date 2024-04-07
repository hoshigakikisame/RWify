<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RW\RWController;
use App\Http\Controllers\RW\Manage\ManageWargaController;
use App\Http\Controllers\RW\Manage\ManagePengumumanController;
use App\Http\Controllers\RW\Manage\ManageUmkmController;

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

        // rw manage warga routes
        Route::group([
            'prefix' => 'warga',
            'as' => 'warga.'
        ], function() {
            Route::get('', [ManageWargaController::class, 'manageWargaPage'])->name('warga');
            Route::post('new', [ManageWargaController::class, 'addNewWarga'])->name('new');
            Route::post('update', [ManageWargaController::class, 'updateWarga'])->name('update');
            Route::post('delete', [ManageWargaController::class, 'deleteWarga'])->name('delete');
        });

        // rw manage pengumuman routes
        Route::group([
            'prefix' => 'pengumuman',
            'as' => 'pengumuman.'
        ], function() {
            Route::get('', [ManagePengumumanController::class, 'managePengumumanPage'])->name('pengumuman');
            Route::post('new', [ManagePengumumanController::class, 'addNewPengumuman'])->name('new');
            Route::post('update', [ManagePengumumanController::class, 'updatePengumuman'])->name('update');
            Route::post('delete', [ManagePengumumanController::class, 'deletePengumuman'])->name('delete');
        });

        // rw manage umkm routes
        Route::group([
            'prefix' => 'umkm',
            'as' => 'umkm.'
        ], function() {
            Route::get('', [ManageUmkmController::class, 'manageUmkmPage'])->name('umkm');
            Route::post('new', [ManageUmkmController::class, 'addNewUmkm'])->name('new');
            Route::post('update', [ManageUmkmController::class, 'updateUmkm'])->name('update');
            Route::post('delete', [ManageUmkmController::class, 'deleteUmkm'])->name('delete');
        });

    });
});

