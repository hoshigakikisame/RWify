<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;

// user routes
Route::group(
    [
        'prefix' => 'user',
        'as' => 'user.',
        'middleware' => ['auth']
    ],

    function () {

        Route::group(
            [
                'prefix' => 'profile',
                'as' => 'profile.'
            ],
            function () {
                Route::get('', [UserController::class, 'profile'])->name('index');
                Route::post('update', [UserController::class, 'updateProfile'])->name('update');
                Route::post('update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
                Route::post('update-image', [UserController::class, 'updateProfileImage'])->name('updateImage');
            }
        );


        Route::group(
            [
                'prefix' => 'verification',
                'as' => 'verification.'
            ],
            function () {
                Route::get('send', [UserController::class, 'sendVerificationEmail'])->name('send');
            }
        );

        Route::group(
            [
                'prefix' => 'notification',
                'as' => 'notification.'
            ],
            function () {
                Route::post('mark-as-read', [UserController::class, 'markNotificationAsRead'])->name('markAsRead');
            }
        );
    }
);

// special route for email verification
Route::get('verify/{id}/{hash}', [UserController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->withoutScopedBindings()->name('verification.verify');