<?php

namespace Water\Vular\Models;

trait SlugFindable{
    static function findBySlug($slug){
    	return self::where('slug', $slug)->first();
    }
	
}