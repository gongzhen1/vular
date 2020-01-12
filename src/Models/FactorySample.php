<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class FactorySample extends Model
{
    public function user()
    {
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function supplier()
    {
         return $this->belongsTo('Water\Vular\Models\Supplier');
    }

    public function sample(){
         return $this->belongsTo('Water\Vular\Models\Sample');
    }
}
