<?php

namespace App\Models;

class Driver extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dni'
    ];

    /**
     * The attributes that will be casted as dates
     * @var array
     */
    protected $dates = [
      'created_at', 'updated_at'  
    ];

    //Relations
    public function routes() 
    {
        return $this->belongsToMany('App\Models\Route', 'drivers_route', 'driver_id', 'route_id');
    }
}