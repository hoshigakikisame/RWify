<?php

use App\Http\Controllers\Shared\SharedController;
use Illuminate\Support\Facades\Route;

Route::get('', [SharedController::class, 'index'])
    ->name('index');

require __DIR__.'/auth.route.php';
require __DIR__.'/rt.route.php';
require __DIR__.'/rw.route.php';
require __DIR__.'/warga.route.php';
require __DIR__.'/petugasKeamanan.route.php';
require __DIR__.'/shared.route.php';
require __DIR__.'/user.route.php';