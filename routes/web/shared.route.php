<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shared\LayananController;

// rw routes
Route::group([
    'prefix' => '',
    'as' => '',
    'middleware' => ['auth', 'hasRole:Ketua Rukun Warga']
], function () {

    Route::group([
        'prefix' => 'layanan',
        'as' => 'layanan.'
    ], function () {
        Route::get('permintaan-dokumen', [LayananController::class, 'permintaanDokumen'])->name('permintaanDokumen');
        Route::get('pengaduan', [LayananController::class, 'pengaduan'])->name('pengaduan');
        Route::get('pembayaran-iuran', [LayananController::class, 'pembayaranIuran'])->name('pembayaranIuran');
    });

});

