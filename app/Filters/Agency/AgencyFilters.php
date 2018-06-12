<?php
/**
 * Created by PhpStorm.
 * User: ibrahim
 * Date: 6/12/2018
 * Time: 2:10 PM
 */

namespace App\Filters\Agency;

use App\Filters\FiltersAbstract;

class AgencyFilters extends FiltersAbstract
{
    protected $filters = [
        'name' => NameFilter::class
    ];
}
