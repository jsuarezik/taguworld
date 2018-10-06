<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    const filterMap = [
        'origin' => 'App\Http\Controllers\Filters\Origin',
        'destination' => 'App\Http\Controllers\Filters\Destination'
    ];

    public static function apply (Request $filters, $model, $query) 
    {   
        
        foreach ($filters->input('filters', []) as $key => $filter) {
            //Proccess filters
            if (!array_key_exists($filter['name'], static::filterMap)) {
                continue;
            }
            
            //Check the existence of the class
            $decorator = static::filterMap[$filter['name']];
            
            if (class_exists($decorator)) {
                $decorator::apply($query, $filter['value'], true);
            }
        }

        return $query;
    }
}
