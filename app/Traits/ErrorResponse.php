<?php

namespace App\Traits;

trait ErrorResponse
{
    public function errorResponse()
    {
        return response()->json([
            "success" => false,
            ]);
    }/*
        end of handle err message
    */
}
