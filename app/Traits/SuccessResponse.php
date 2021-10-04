<?php

namespace App\Traits;

trait SuccessResponse
{
    public function successResponse($data)
    {
        return response()->json([
            "success" => true,
            "data" => $data
            ]);
    }/*
        end of response message
    */
}
