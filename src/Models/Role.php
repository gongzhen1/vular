<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    public function admins()
    {
         return $this->belongsToMany('Water\Vular\Models\Admin');
    }

    public function isPermitted($authPoint){
        foreach (explode(",", $this->permissions) as $value) {
            if($authPoint == $value){
                return true;
            }
        }
        return false;
    }

}
