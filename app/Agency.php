<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Filters\Agency\AgencyFilters;


class Agency extends Model
{

    /** @var array $fillable */
    protected $fillable = ['name', 'mobile', 'phone', 'uid'];

    public function scopeFilter(Builder $builder,Request $request):Builder
    {
        return (new AgencyFilters($request))->filter($builder);
    }
}
