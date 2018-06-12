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
    /**
     * @var array $filters
     */
    protected $filters = [
        'name' => NameFilter::class ,
        'phone' => PhoneFilter::class ,
        'mobile' => MobilFilter::class ,
        'uid' => UidFilter::class ,
        'all' => AllFilter::class
    ];
}
