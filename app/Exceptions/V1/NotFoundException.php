<?php

namespace App\Exceptions\V1;

use App\Traits\ApiResponses;
use Exception;


class NotFoundException extends Exception
{

    use ApiResponses;

    public function render(Exception $e, $request)
    {
        $className = get_class($e);
        $className = explode('\\', $className);

        return $this->error([
            'status' => 404,
            'message' =>  $e->getMessage(),
            'source' => end($className)
        ], 404);
    }
}
