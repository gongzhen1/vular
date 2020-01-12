<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{

    public function user()
    {
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function customer()
    {
         return $this->belongsTo('Water\Vular\Models\Customer');
    }

    public function factorySamples(){
         return $this->hasMany('Water\Vular\Models\FactorySample');
    }
}
