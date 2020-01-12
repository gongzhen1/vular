<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model{
	use SlugFindable;


    public function pages(){
        return $this->hasMany('Water\Vular\Models\Page');
    }
}
