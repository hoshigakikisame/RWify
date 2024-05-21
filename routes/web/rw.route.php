<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RW\RWController;
use App\Http\Controllers\RW\Manage\ManageWargaController;
use App\Http\Controllers\RW\Manage\ManagePengumumanController;
use App\Http\Controllers\RW\Manage\ManageUmkmController;
use App\Http\Controllers\RW\Manage\ManageReservasiJadwalTemuController;
use App\Http\Controllers\RW\Manage\ManagePengaduanController;
use App\Http\Controllers\RW\Manage\ManagePropertiController;
use App\Http\Controllers\RW\Manage\ManageTipePropertiController;
use Illuminate\Routing\Router;

// rw routes
Route::group([
    'prefix' => 'rw',
    'as' => 'rw.',
    'middleware' => ['auth', 'hasRole:Ketua Rukun Warga']
], function () {
    Route::get('dashboard', [RWController::class, 'dashboard'])->name('dashboard');

    // rw manage routes
    Route::group([
        'prefix' => 'manage',
        'as' => 'manage.'
    ], function () {

        // rw manage warga routes
        Route::group([
            'prefix' => 'warga',
            'as' => 'warga.'
        ], function () {
            Route::get('', [ManageWargaController::class, 'manageWargaPage'])->name('warga');
            Route::post('new', [ManageWargaController::class, 'addNewWarga'])->name('new');
            Route::post('update', [ManageWargaController::class, 'updateWarga'])->name('update');
            Route::post('delete', [ManageWargaController::class, 'deleteWarga'])->name('delete');
            
            Route::post('import-csv', [ManageWargaController::class, 'importCSV'])->name('importCSV');
        });

        // rw manage pengumuman routes
        Route::group([
            'prefix' => 'pengumuman',
            'as' => 'pengumuman.'
        ], function () {
            Route::get('', [ManagePengumumanController::class, 'managePengumumanPage'])->name('pengumuman');
            Route::post('new', [ManagePengumumanController::class, 'addNewPengumuman'])->name('new');
            Route::post('update', [ManagePengumumanController::class, 'updatePengumuman'])->name('update');
            Route::post('delete', [ManagePengumumanController::class, 'deletePengumuman'])->name('delete');
            Route::post('changeStatus', [ManagePengumumanController::class, 'changeStatusPengumuman'])->name('changeStatus');
        });

        // rw manage umkm routes
        Route::group([
            'prefix' => 'umkm',
            'as' => 'umkm.'
        ], function () {
            Route::get('', [ManageUmkmController::class, 'manageUmkmPage'])->name('umkm');
            Route::post('new', [ManageUmkmController::class, 'addNewUmkm'])->name('new');
            Route::post('update', [ManageUmkmController::class, 'updateUmkm'])->name('update');
            Route::post('delete', [ManageUmkmController::class, 'deleteUmkm'])->name('delete');
        });

        // rw manage pengaduan routes
        Route::group([
            'prefix' => 'pengaduan',
            'as' => 'pengaduan.'
        ], function () {
            Route::get('', [ManagePengaduanController::class, 'managePengaduanPage'])->name('pengaduan');
            Route::post('new', [ManagePengaduanController::class, 'addNewPengaduan'])->name('new');
            Route::post('update', [ManagePengaduanController::class, 'updatePengaduan'])->name('update');
            Route::post('delete', [ManagePengaduanController::class, 'deletePengaduan'])->name('delete');
        });

        Route::group([
            'prefix' => 'reservasiJadwalTemu',
            'as' => 'reservasiJadwalTemu.'
        ], function () {
            Route::get('', [ManageReservasiJadwalTemuController::class, 'manageReservasiJadwalTemuPage'])->name('index');
            Route::post('update', [ManageReservasiJadwalTemuController::class, 'updateReservasiJadwalTemu'])->name('update');
        });

        // rw manage properti routes
        Route::group([
            'prefix' => 'properti',
            'as' => 'properti.'
        ], function () {
            Route::get('', [ManagePropertiController::class, 'managePropertiPage'])->name('index');
            Route::post('new', [ManagePropertiController::class, 'addNewProperti'])->name('new');
            Route::post('update', [ManagePropertiController::class, 'updateProperti'])->name('update');
            Route::post('delete', [ManagePropertiController::class, 'deleteProperti'])->name('delete');
        });

        // rw manage tipe properti routes
        Route::group([
            'prefix' => 'tipeProperti',
            'as' => 'tipeProperti.'
        ], function () {
            Route::get('', [ManageTipePropertiController::class, 'manageTipePropertiPage'])->name('index');
            Route::post('new', [ManageTipePropertiController::class, 'addNewTipeProperti'])->name('new');
            Route::post('update', [ManageTipePropertiController::class, 'updateTipeProperti'])->name('update');
            Route::post('delete', [ManageTipePropertiController::class, 'deleteTipeProperti'])->name('delete');
        });
    });
});
