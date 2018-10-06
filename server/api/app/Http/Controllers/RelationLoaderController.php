<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationLoaderController extends Controller
{
    const modelRelationMap = [
        'route' => 'App\Http\Controllers\Relations\Route'
    ];

    public static function apply (Request $withs, $model, $query) 
    {   
        $className = strtolower(class_basename($model));
        $decorator = static::modelRelationMap[$className];
        if (class_exists($decorator)) {
            $decorator::apply($query, $withs->input('with', []));
        }

        return $query;
    }
}
