<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public function products()
    {
        return $this->belongsToMany('Water\Vular\Models\Product')->where('status','2-published')->orderBy('order')->orderBy('created_at', 'desc');
    }

    static function findBySlug($slug){
    	return self::where('slug', $slug)->first();
    }

}
