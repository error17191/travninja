<?php

namespace App\Traits;

trait PaginatedTrait
{

    public function scopePaginated($query, $pageLimit = null)
    {
        $myPageLimit = 15;
        if(!$pageLimit){
            $myPageLimit = $pageLimit;
        }else if(isset($this->pageLimit)){
            $myPageLimit = $this->pageLimit;
        }
        return $query->paginate($myPageLimit);
    }
}
