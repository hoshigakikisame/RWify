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
        Route::group([
            'prefix' => 'pengaduan',
            'as' => 'pengaduan.'
        ], function () {
            Route::get('detail/{idPengaduan}', [LayananController::class, 'pengaduanDetail'])->name('detail');
        });
    });
});

