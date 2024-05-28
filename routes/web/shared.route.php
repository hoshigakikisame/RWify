<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shared\LayananController;
use App\Http\Controllers\Shared\InformasiController;
use App\Http\Controllers\Shared\SharedController;

// rw routes
Route::group([
    'prefix' => '',
    'as' => '',
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
        // umkm
        Route::get('umkm', [InformasiController::class, 'umkmPage'])->name('umkmPage');
        
        Route::group([
            'prefix' => 'pengumuman',
            'as' => 'pengumuman.'
        ], function () {
            Route::get('', [InformasiController::class, 'pengumumanPage'])->name('index');
            Route::get('detail/{idPengumuman}', [InformasiController::class, 'pengumumanDetailPage'])->name('detail');
        });
    });
});

// shared routes
Route::get('hubungi-kami', [SharedController::class, 'hubungiKami'])->name('hubungiKami');


