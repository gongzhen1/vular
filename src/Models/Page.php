<?php

namespace Water\Vular\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model{
    use SlugFindable;
    /*public function medias(){
        return $this->belongsToMany('Water\Vular\Models\Media', 'page_media')
        	->withPivot('order','alt_text')->orderBy('page_media.order');
    }*/
    public function attributes(){
        return $this->belongsToMany('Water\Vular\Models\PageAttribute');
    }

    public function pageCategory(){
        return $this->belongsTo('Water\Vular\Models\PageCategory');
    }

    public function seoMeta(){
        return $this->hasOne('Water\Vular\Models\SeoMeta');
    }

    public function ogMeta(){
        return $this->hasOne('Water\Vular\Models\OgMeta');
    }

    public function featureImage(){
        return $this->belongsTo('Water\Vular\Models\Media');
    }

    //public function avatar(){
    //    $avatar = $this->avatarMedia;
    //    return $avatar ? $avatar->fitName(350,350) : 'avatar-blank.jpg';
    //}

    public function featureMedia(){
        $media = $this->featureImage;
        $size = page_media_size();
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

    public function featureThumbnail(){
        $media = $this->featureImage;
        $size = page_media_thumb_size();
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

}
