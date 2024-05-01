<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// app imports
use App\Http\Middleware\EnsureUserHasRole;
use App\Models\UserModel;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/web.php',
        commands: __DIR__ . '/../routes/console/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn(Request $request) => route('auth.signInPage'));
        $middleware->redirectUsersTo(function () {
            /**
             * @var UserModel $user
             */
            $user = Auth::user();
            return $user->getDashboardRoute();
        });
        $middleware->alias([
            'hasRole' => EnsureUserHasRole::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
