<?php

namespace App\Traits;


trait ApiResponses
{

    public function ok($message, $data = [])
    {
        return $this->success($message, $data, 200);
    }

    public function success($message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

    public function error($errors = [], $statusCode = 500)
    {
        if (is_string($errors)) {
            return response()->json([
                'message' => $errors,
                'status' => $statusCode
            ], $statusCode);
        }

        return response()->json($errors);
    }
}
