<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Warga\WargaController;
use App\Http\Controllers\Warga\Layanan\Pengaduan\PengaduanWargaController;

// rw routes
Route::group([
    'prefix' => 'warga',
    'as' => 'warga.',
    'middleware' => ['auth', 'hasRole:Warga']
], function() {
    Route::get('dashboard', [WargaController::class, 'dashboard'])->name('dashboard');
    
    // rw manage routes
    Route::group([
        'prefix' => 'layanan',
        'as' => 'layanan.'
    ], function() {

        // rw manage warga routes
        Route::group([
            'prefix' => 'pengaduan',
            'as' => 'pengaduan.'
        ], function() {
            // pages
            Route::get('', [PengaduanWargaController::class, 'pengaduanPage'])->name('index');
            Route::get('new', [PengaduanWargaController::class, 'newPengaduanPage'])->name('newPengaduanPage');
            
            // post
            Route::post('new', [PengaduanWargaController::class, 'addNewPengaduan'])->name('new');
            Route::post('delete', [PengaduanWargaController::class, 'deleteWarga'])->name('delete');
        });
    });
});

