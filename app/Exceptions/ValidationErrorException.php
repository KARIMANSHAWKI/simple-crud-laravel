<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class ValidationErrorException extends Exception
{
    public function validationException()
    {
        return ValidationException::withMessages([]);
    }
}
