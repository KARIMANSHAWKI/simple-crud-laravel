<?php

namespace App\Traits;

trait ErrorResponse
{
    public function errorResponse(\Exception $e)
    {
        return response()->json([
            "data" => $e->getMessage(),
            "success" => false,
            ], 404);
    }/*
        end of handle err message
    */
}
