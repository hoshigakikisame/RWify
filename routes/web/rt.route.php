<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RT\RTController;
use App\Http\Controllers\RT\Manage\ManageWargaController;
use App\Http\Controllers\RT\Manage\ManagePengaduanController;
use App\Http\Controllers\RT\Manage\ManageReservasiJadwalTemuController;

// rt routes
Route::group([
    'prefix' => 'rt',
    'as' => 'rt.',
    'middleware' => ['auth', 'hasRole:Ketua Rukun Tetangga']
], function () {
    Route::get('dashboard', [RTController::class, 'dashboard'])->name('dashboard');
    // rw manage routes
    Route::group([
        'prefix' => 'manage',
        'as' => 'manage.'
    ], function () {
        Route::get('warga', [ManageWargaController::class, 'manageWargaPage'])->name('warga');
        Route::get('pengaduan', [ManagePengaduanController::class, 'managePengaduanPage'])->name('pengaduan');

        Route::group([
            'prefix' => 'reservasiJadwalTemu',
            'as' => 'reservasiJadwalTemu.'
        ], function () {
            Route::get('', [ManageReservasiJadwalTemuController::class, 'manageReservasiJadwalTemuPage'])->name('index');
            Route::post('update', [ManageReservasiJadwalTemuController::class, 'updateReservasiJadwalTemu'])->name('update');
        });
    });
});
