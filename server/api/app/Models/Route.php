<?php

namespace App\Models;

class Route extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'origin', 
       'destination'
    ];    
   
    /**
     * The attributes that will be casted as dates
     * @var array
     */

    protected $dates = [
        'created_at', 'updated_at'  
    ];

    //Relations

    public function drivers() {
        return $this->belongsToMany('App\Models\Driver', 'drivers_routes', 'route_id', 'driver_id');
    }
    
}