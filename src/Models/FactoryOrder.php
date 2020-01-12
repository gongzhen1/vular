<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class FactoryOrder extends Model
{
    public function supplier()
    {
         return $this->belongsTo('Water\Vular\Models\Supplier');
    }

    public function order(){
         return $this->belongsTo('Water\Vular\Models\Order');
    }
}
