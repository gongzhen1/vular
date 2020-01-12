<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class PageAttribute extends Model{
    use SlugFindable;
    public function pages()
    {
        return $this->belongsToMany('Water\Vular\Models\Page')->orderBy('order')->orderBy('created_at', 'desc');
    }

}
