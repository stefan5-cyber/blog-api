<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;


class ApiController extends Controller
{

    use ApiResponses;

    protected $policyClass;

    public function isAble($ability, $model)
    {
        Gate::authorize($ability, [$model, $this->policyClass]);
    }
}
