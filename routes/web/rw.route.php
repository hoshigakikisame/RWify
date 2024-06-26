<?php

use App\Http\Controllers\RW\Manage\ManageIuranController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RW\RWController;
use App\Http\Controllers\RW\Manage\ManageWargaController;
use App\Http\Controllers\RW\Manage\ManagePengumumanController;
use App\Http\Controllers\RW\Manage\ManageUmkmController;
use App\Http\Controllers\RW\Manage\ManageReservasiJadwalTemuController;
use App\Http\Controllers\RW\Manage\ManagePengaduanController;
use App\Http\Controllers\RW\Manage\ManagePropertiController;
use App\Http\Controllers\RW\Manage\ManageTipePropertiController;
use App\Http\Controllers\RW\Manage\ManageKartuKeluargaController;
use App\Http\Controllers\RW\Manage\ManageBansosController;

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

        Route::group([
            'prefix' => 'pendataan',
            'as' => 'pendataan.'
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
                Route::get('export-csv', [ManageWargaController::class, 'exportCSV'])->name('exportCSV');
            });

            // rw manage kartu keluarga routes
            Route::group([
                'prefix' => 'kartuKeluarga',
                'as' => 'kartuKeluarga.'
            ], function () {
                Route::get('', [ManageKartuKeluargaController::class, 'manageKartuKeluargaPage'])->name('kartuKeluarga');
                Route::post('new', [ManageKartuKeluargaController::class, 'addNewKartuKeluarga'])->name('new');
                Route::post('update', [ManageKartuKeluargaController::class, 'updateKartuKeluarga'])->name('update');
                Route::post('delete', [ManageKartuKeluargaController::class, 'deleteKartuKeluarga'])->name('delete');

                Route::post('import-csv', [ManageKartuKeluargaController::class, 'importCSV'])->name('importCSV');
                Route::get('export-csv', [ManageKartuKeluargaController::class, 'exportCSV'])->name('exportCSV');
            });
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

            Route::get('export-csv', [ManagePropertiController::class, 'exportCSV'])->name('exportCSV');
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

        // rw manage tipe properti routes
        Route::group([
            'prefix' => 'iuran',
            'as' => 'iuran.'
        ], function () {
            Route::get('', [ManageIuranController::class, 'manageIuranPage'])->name('index');
            Route::post('new', [ManageIuranController::class, 'addNewIuran'])->name('new');
            Route::post('update', [ManageIuranController::class, 'updateIuran'])->name('update');
            Route::post('delete', [ManageIuranController::class, 'deleteIuran'])->name('delete');
            Route::get('verify', [ManageIuranController::class, 'verifyPembayaranIuranPage'])->name('verify');

            Route::get('export-csv', [ManageIuranController::class, 'exportCSV'])->name('exportCSV');

        });

        Route::group([
            'prefix' => 'bansos',
            'as' => 'bansos.'
        ], function () {
            Route::get('mfep', [ManageBansosController::class, 'bansosMfepPage'])->name('mfep');
            Route::get('export-mfep', [ManageBansosController::class, 'exportMfep'])->name('exportMfep');
            Route::get('saw', [ManageBansosController::class, 'bansosSawPage'])->name('saw');
            Route::get('export-saw', [ManageBansosController::class, 'exportSaw'])->name('exportSaw');
        });
    });
});
