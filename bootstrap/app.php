<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AuthDoctor;

return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | Middleware (Laravel 12 way)
    |--------------------------------------------------------------------------
    */

    ->withMiddleware(function (Middleware $middleware) {

        // Register middleware alias
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'auth.doctor' => AuthDoctor::class,
        ]);
    })

    /*
    |--------------------------------------------------------------------------
    | Exception Handling (THIS WAS MISSING ❌)
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
