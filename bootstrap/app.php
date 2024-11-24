<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([           
            'check_session_expiration' => \App\Http\Middleware\CheckSessionExpiration::class,
        ]);
        $middleware->web(append:[
            \App\Http\Middleware\LocaleMiddleware::class,
        ]);
        
    })->withEvents(discover: [
        __DIR__.'/../app/Domain/Listeners',
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
