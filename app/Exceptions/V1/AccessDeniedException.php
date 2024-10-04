<?php

namespace App\Exceptions\V1;

use App\Traits\ApiResponses;
use Exception;


class AccessDeniedException extends Exception
{

    use ApiResponses;

    public function render($e, $request)
    {

        $className = get_class($e);
        $className = explode('\\', $className);

        return $this->error([
            'status' => 403,
            'message' => $e->getMessage(),
            'source' => end($className)
        ], 403);
    }
}
