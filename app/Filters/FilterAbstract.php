<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 6/12/2018
 * Time: 1:30 PM
 */

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract
{
    /**
     * apply the filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    abstract public function filter(Builder $builder,string $value):Builder;

    /**
     * create an array of mappings for the filters
     *
     * @return array
     */
    protected function mappings():array
    {
        return [];
    }

    /**
     * get the value that will be filtered with
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function resolveFilterValue(string $key)
    {
        return array_get($this->mappings(),$key);
    }
}
