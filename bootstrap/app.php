<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sensor.value.parsing' => \App\Http\Middleware\SensorValueBodyParsing::class,
            'sensor.ids.parsing' => \App\Http\Middleware\SensorIdsQueryParser::class,
            'sensor.types.parsing' => \App\Http\Middleware\SensorTypesQueryParser::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
