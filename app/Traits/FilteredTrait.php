<?php

namespace App\Traits;

trait FilteredTrait
{
    public function scopeFiltered($query, $searchToken)
    {
        if(!$searchToken){
            return $query;
        }
        foreach ($this->filterBy as $column) {
            $query->orWhere($column , 'like' , '%' . $searchToken . '%');
        }
        return $query;
    }
}
