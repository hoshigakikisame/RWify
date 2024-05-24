<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RT\RTController;
use App\Http\Controllers\RT\Manage\ManageWargaController;
use App\Http\Controllers\RT\Manage\ManagePengaduanController;
use App\Http\Controllers\RT\Manage\ManageReservasiJadwalTemuController;
use App\Http\Controllers\RT\Layanan\PengaduanRtController;
use App\Http\Controllers\RT\Layanan\PembayaranIuranRtController;
use App\Http\Controllers\Warga\Layanan\PembayaranIuranWargaController;


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

    Route::group([
        'prefix' => 'layanan',
        'as' => 'layanan.'
    ], function() {

        // warga manage warga routes
        Route::group([
            'prefix' => 'pengaduan',
            'as' => 'pengaduan.'
        ], function() {
            // pages
            Route::get('', [PengaduanRtController::class, 'pengaduanPage'])->name('index');
            Route::get('new', [PengaduanRtController::class, 'newPengaduanPage'])->name('newPengaduanPage');
            
            // post
            Route::post('new', [PengaduanRtController::class, 'addNewPengaduan'])->name('new');
            Route::post('delete', [PengaduanRtController::class, 'deletePengaduan'])->name('delete');
        });

        // warga manage iuran routes
        Route::group([
            'prefix' => 'pembayaranIuran',
            'as' => 'pembayaranIuran.'
        ], function() {
            // pages
            Route::get('riwayat', [PembayaranIuranWargaController::class, 'riwayatPembayaranIuranPage'])->name('riwayatPembayaranIuran');
            Route::get('new', [PembayaranIuranWargaController::class, 'newPembayaranIuranPage'])->name('newIuranPage');
            
            // post
            Route::post('new', [PembayaranIuranWargaController::class, 'addNewPembayaranIuran'])->name('new');
        });
    });
});
