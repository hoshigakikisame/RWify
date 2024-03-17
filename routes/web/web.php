<?php

use App\Http\Controllers\Shared\SharedController;
use Illuminate\Support\Facades\Route;

Route::get('', [SharedController::class, 'index'])
    ->name('index');

require __DIR__.'/auth.route.php';
