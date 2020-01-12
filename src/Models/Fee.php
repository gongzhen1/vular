<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    public function order(){
         return $this->belongsTo('Water\Vular\Models\Order');
    }
}
