<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use FFI\Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            
            if($exception instanceof \Illuminate\Auth\AuthenticationException ){
                $statusCode = Response::HTTP_UNAUTHORIZED;
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.unauthenticated')
                ];
            } else if ($exception instanceof ValidationException) {
                $msg = trans('messages.api.common.validator');
                foreach ($exception->errors() as $field => $errors) {
                    foreach ($errors as $key => $value) {
                        $msg = $value;
                        continue;
                    }
                }
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $response = [
                    'code' => $statusCode,
                    'msg' => $msg
                ];
            } else if ($exception instanceof ModelNotFoundException) {
                $statusCode = Response::HTTP_NOT_FOUND;
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.notfound')
                ];
            } else if ( $exception instanceof  NotFoundHttpException) {
                $statusCode = Response::HTTP_NOT_FOUND;
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.url_notfound')
                ];
            } else if ( $exception instanceof  MethodNotAllowedHttpException) {
                $statusCode = Response::HTTP_NOT_FOUND;
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.method_notfound')
                ];
            }else if ( $exception instanceof  QueryException) {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.database_disconnect')
                ];
            } else {
                $response = [
                    'code' => $statusCode,
                    'msg' => trans('messages.api.common.unknown_error')
                ];
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
            return response()->json($response, $statusCode
            );
        }
        return parent::render($request, $exception);
    }
}
