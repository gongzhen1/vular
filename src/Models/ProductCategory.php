<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model{
	use VularTree, SlugFindable;


    public function products(){
        return $this->belongsToMany('Water\Vular\Models\Product');
    }

}
