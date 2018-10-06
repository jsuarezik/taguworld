<?php

namespace App\Models;
use Auth;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{

    const SUPERADMIN = 1;

    //Relations
    public function creator() 
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    //Mutators
    public function setCreatedByAttribute($user) {
        $this->attributes['created_by'] = $user->id;
    }

    
    //Functions
    public function delete() {
        $this->attributes['status'] = 0;
        $this->save();
        return true;
    }

    public function isSuperAdmin() {
        return Auth::user()->role->id == self::SUPERADMIN;
    }

    public function isOwn() {
        return $this->creator->id == Auth::user()->id;

    }

    public function canDeleteOwn() {
        return $this->isOwn() || $this->isSuperAdmin();
    }

}