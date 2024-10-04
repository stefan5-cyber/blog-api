<?php

namespace App\Exceptions\V1;

use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Exception;


class AuthenticationException extends Exception
{

    use ApiResponses;

    public function render(Exception $e, Request $request): JsonResponse
    {
        $className = get_class($e);
        $className = explode('\\', $className);

        return $this->error([
            'status' => 401,
            'message' => $e->getMessage(),
            'source' => end($className)
        ], 401);
    }
}
