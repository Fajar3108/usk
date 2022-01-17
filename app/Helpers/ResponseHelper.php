<?php

namespace App\Helpers;

class ResponseHelper {
    public static function buildSuccess($message, $data, $code)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }

    public static function buildError($message, $error, $code)
    {
        return response()->json([
            'message' => $message,
            'error' => $error,
            'code' => $code,
        ], $code);
    }
}
