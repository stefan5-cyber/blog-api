<?php


namespace App\Http\Filters;


class PostFilter extends QueryFilter
{

    public function status($value)
    {
        $this->builder->whereIn('status', explode(',', $value)); // slug filter[status]=A,C
    }

    public function title($value)
    {
        $likeStr =  str_replace('*', '%', $value);
        $this->builder->where('title', 'like', $likeStr);
    }

    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates); // slug filter[createdAt]=date1,date2
        }

        return $this->builder->where('created_at', $value);
    }

    public function updatedAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates); // slug filter[updatedAt]=date1,date2
        }

        return $this->builder->where('updated_at', $value);
    }
}
