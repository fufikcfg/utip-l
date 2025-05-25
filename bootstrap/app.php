<?php

use App\Modules\Users\UI\CLI\CreateUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: (new \App\Kernel\PathConfigFiles\Routes\PathConfigAPIRouteFiles())->handle(),
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, Throwable $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        });
    })->withCommands([CreateUser::class]
    )->create();
