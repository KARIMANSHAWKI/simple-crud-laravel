<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
        'current_password',
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

        });

     //Handle Validation Exception
        $this->renderable(function (ValidationException $e , $request){
            if($request->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Failed',
                    'data' => null,
                    'error' => $e->errors()
                ], 422);
            }
        });

        //Handle Authorization Exception
        $this->renderable(function (AuthenticationException $e , $request){
            if($request->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Valid Auth Credential Exception',
                    'data' => null,
                    'error' => null
                ], 401);
            }

            return redirect()->guest('login');
        });


        //Handle NotFound Exception
        $this->renderable(function (AuthenticationException $e , $request){
            if($request->expectsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Valid Auth Credential Exception',
                    'data' => null,
                    'error' => null
                ], 404);
            }
        });
    }
}
