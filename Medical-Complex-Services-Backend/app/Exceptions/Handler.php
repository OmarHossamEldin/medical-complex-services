<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class,
        Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function ($request, Throwable $e) {
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Resource not found'
                ], 404);
            }
            return parent::render($request, $e);
        });
    }

    public function render($request, Throwable $exception)
    {
       
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => 'Resource not fsssound'
            ], 404);
        }

        
    }
}
