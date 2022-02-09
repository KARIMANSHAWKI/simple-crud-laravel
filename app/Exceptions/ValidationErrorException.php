<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class ValidationErrorException extends Exception
{
    public function render(Throwable $e) : JsonResponse
    {
        return response()->json(['errors' => [$e->getMessage()]], 422);
    }
}
