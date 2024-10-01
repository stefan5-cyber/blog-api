<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;


class AuthorFilter extends QueryFilter
{

    public function id($value): Builder
    {
        return $this->builder->whereIn('id', explode(',', $value));
    }

    public function name($value): Builder
    {
        return $this->builder->where('name', $value);
    }

    public function email($value): Builder
    {
        return $this->builder->where('email', $value);
    }

    public function include($value): Builder
    {
        return $this->builder->with($value);
    }

    public function createdAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates); // slug filter[createdAt]=date1,date2
        }

        return $this->builder->where('created_at', $value);
    }

    public function updatedAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates); // slug filter[updatedAt]=date1,date2
        }

        return $this->builder->where('updated_at', $value);
    }
}
