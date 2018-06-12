<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 6/12/2018
 * Time: 4:42 PM
 */

namespace App\Filters\Agency;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class AllFilter extends FilterAbstract
{
    /**
     * apply the filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, string $value): Builder
    {
        $value = trim($value);
        $columns = [
            'name' , 'uid' , 'phone' , 'mobile'
        ];
        foreach ($columns as $column) {
            $builder->orWhere($column,'like','%' .$value . '%');
        }
        return $builder;
    }
}
