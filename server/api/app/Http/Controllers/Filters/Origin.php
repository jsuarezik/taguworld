<?php

namespace App\Http\Controllers\Filters;

class Origin implements Filter
{
    /**
     * Method to return the query builder to search for a specific username, the $extra parameter is used to know if it's like or equal
     * @return $builder 
     */
    public static function apply($builder, $value, $extra = false)
    {
        return $extra ? $builder->where('origin', 'like', '%'.$value.'%') : $builder->where('origin', $value);
    }
}