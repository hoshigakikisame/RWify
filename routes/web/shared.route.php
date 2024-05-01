<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shared\LayananController;
use App\Http\Controllers\Shared\InformasiController;

// rw routes
Route::group([
    'prefix' => '',
    'as' => '',
    'middleware' => ['auth']
], function () {
    Route::group([
        'prefix' => 'layanan',
        'as' => 'layanan.'
    ], function () {
        Route::group([
            'prefix' => 'pengaduan',
            'as' => 'pengaduan.'
        ], function () {
            Route::get('detail/{idPengaduan}', [LayananController::class, 'pengaduanDetail'])->name('detail');
        });
    });

    Route::group([
        'prefix' => 'informasi',
        'as' => 'informasi.'
    ], function () {
        Route::get('umkm', [InformasiController::class, 'umkmPage'])->name('umkmPage');
    });
});

