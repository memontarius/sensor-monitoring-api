<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sensor.value.parser' => \App\Http\Middleware\SensorValueBodyParser::class,
            'array.query.parser' => \App\Http\Middleware\CommaSeparatedQueryParser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn (NotFoundHttpException $e) => abortWithNotFound());
        $exceptions->render(fn (MethodNotAllowedHttpException $e) => abortWithNotFound());
    })->create();

function abortWithNotFound(): void
{
    abort(response()->json(['message' => 'Not Found'], 404));
}
