<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\V1\AuthorFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;


class UserFilter extends AuthorFilter
{

    protected $sortable = ['name', 'email', 'role', 'createdAt' => 'created_at', 'updatedAt' => 'updated_at'];

    public function role($value): Builder
    {
        $filterValues = explode(',', $value);

        return $this->builder->whereIn('role', $filterValues);
    }

    public function isAdmin($value): Builder
    {
        return $this->builder->where('is_admin', $value);
    }
}
