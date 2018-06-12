<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 6/12/2018
 * Time: 4:26 PM
 */

namespace App\Filters\Agency;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PhoneFilter extends FilterAbstract
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
        return $builder->where('phone','like' , '%' .$value . '%');
    }
}
