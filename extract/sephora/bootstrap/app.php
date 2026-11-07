<?php

use App\Http\Middleware\ForceHttps;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\ShareCartCount;
use App\Http\Middleware\TrustProxies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // TrustProxies first so X-Forwarded-Proto/For are honoured by every
        // later middleware (HTTPS detection, rate-limit buckets, client IP).
        $middleware->prependToGroup('web', TrustProxies::class);

        $middleware->web(append: [
            ShareCartCount::class,
            SecurityHeaders::class,
            ForceHttps::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
