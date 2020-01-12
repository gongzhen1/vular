<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{

    public function post()
    {
        return $this->belongsTo('Water\Vular\Models\Post');
    }

}
