<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model{
	use VularTree, SlugFindable;


    public function posts(){
        return $this->belongsToMany('Water\Vular\Models\Post');
    }
}
