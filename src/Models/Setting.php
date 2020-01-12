<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    public function admins()
    {
         return $this->ownerMany('Water\Vular\Models\Admin');
    }
}
