<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;


abstract class QueryFilter
{

    protected $builder;
    protected $request;
    protected $sortable = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get filter[key] form request and call method
     * 
     * @param array $arr
     *
     * @return Builder
     */
    public function filter(array $arr): Builder
    {

        foreach ($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    /**
     * Apply Builder and check request for params
     * ex: filter[key]=value&include=value...
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    /**
     * Sort resources by sortable
     * ex: sort=-status,title
     * 
     * @param $value
     * 
     * @return void
     */
    public function sort($value): void
    {

        $direction = 'asc';
        $sortAttributes = explode(',', $value);

        foreach ($sortAttributes as $sortAttribute) {

            if (strpos($sortAttribute, '-') === 0) {

                $direction = 'desc';
                $sortAttribute = substr($sortAttribute, 1);
            }

            if (in_array($sortAttribute, $this->sortable) || key_exists($sortAttribute, $this->sortable)) {

                $columnName = $this->sortable[$sortAttribute] ?? $sortAttribute; // first check for arrayKey
                $this->builder->orderBy($columnName, $direction);
            }
        }
    }
}
