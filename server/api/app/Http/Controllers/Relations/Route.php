<?php

namespace App\Http\Controllers\Relations;

class Route
{

    const allowedRelations = [
        'drivers'
    ];

    /**
     * Method to return the query builder to lazy load the requested relations of the User model
     * @return $builder 
     */
    public static function apply($builder, $relations)
    {
        foreach ($relations as $relation) {
            if (!in_array($relation, static::allowedRelations)) {
                continue;
            }
            $builder->with($relation);
        }
        
        return $builder;
    }
}