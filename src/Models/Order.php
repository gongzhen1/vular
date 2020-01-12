<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function customer()
    {
         return $this->belongsTo('Water\Vular\Models\Customer');
    }

    public function factoryOrders(){
         return $this->hasMany('Water\Vular\Models\FactoryOrder');
    }

    public function fees(){
         return $this->hasMany('Water\Vular\Models\Fee');
    }
}
