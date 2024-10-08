<?php

use App\Exceptions\V1\AuthenticationException as V1AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\V1\AccessDeniedException;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\V1\NotFoundException;
use Illuminate\Foundation\Application;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return (new AccessDeniedException())->render($e, $request);
        });

        $exceptions->render(function (AuthenticationException $e, $request) {
            return (new V1AuthenticationException())->render($e, $request);
        });

        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return (new NotFoundException())->render($e, $request);
        });
    })->create();
