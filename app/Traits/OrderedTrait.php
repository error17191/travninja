<?php

namespace App\Traits;

trait OrderedTrait
{
    public function scopeOrdered($query, $orderBy = null, $orderType = 'asc')
    {
        if (isset($this->orderBy[$orderBy])) {
            $orderBy = $this->orderBy[$orderBy];
        } else if (!$orderBy || !in_array($orderBy, $this->orderBy)) {
            return $query->latest();
        }
        return $query->orderBy($orderBy, $orderType);
    }
}
