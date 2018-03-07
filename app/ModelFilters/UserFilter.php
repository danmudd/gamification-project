<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function firstName($firstName)
    {
        return $this->where('first_name', 'LIKE', "%$firstName%");
    }

    public function lastName($lastName)
    {
        return $this->where('last_name', 'LIKE', "%$lastName%");
    }

    public function name($name)
    {
        return $this->where(function($q) use ($name)
        {
           return $q->where('first_name', 'LIKE', "%$name%")
               ->orWhere('last_name', 'LIKE', "%$name%");
        });
    }
}
