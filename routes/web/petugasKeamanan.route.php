<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PetugasKeamanan\PetugasKeamananController;

// rw routes
Route::group([
    'prefix' => 'petugasKeamanan',
    'as' => 'petugasKeamanan.',
    'middleware' => ['auth', 'hasRole:Petugas Keamanan']
], function() {
    Route::get('warga-verification', [PetugasKeamananController::class, 'wargaVerificationPage'])->name('wargaVerification');
});