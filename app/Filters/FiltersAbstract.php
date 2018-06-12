<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 6/12/2018
 * Time: 1:17 PM
 */

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    /**
     * @var \Illuminate\Http\Request $request
     */
    protected $request;

    /**
     * @var array $filters
     */
    protected $filters = [];

    /**
     * filtersAbstract class constructor
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * use the given filters to filter throw the model
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder):Builder
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder,$value);
        }
        return $builder;
    }

    /**
     * add new filters from the controller
     *
     * @param array $filters
     *
     * @return \App\Filters\FiltersAbstract
     */
    public function addFilters(array $filters)
    {
        $this->filters = array_merge($this->filters,$filters);
        return $this;
    }

    /**
     * gets the correct filters from the request that matches the stored filters
     *
     * @return array
     */
    protected function getFilters(): array
    {
        return $this->filterFilters();
    }

    /**
     * filter the request to remove any filters with empty values and any filters not in the filters array
     *
     * @return array
     */
    protected function filterFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    /**
     * instantiate the filter class for the given filter     *
     */
    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }
}
