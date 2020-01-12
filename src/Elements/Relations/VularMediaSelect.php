<?php
namespace Water\Vular\Elements\Relations;

use Water\Vular\Elements\Vuetify\VInput;
use Water\Vular\Models\Media;
//use Water\Vular\Elements\Fieldable;
//use Water\Vular\Elements\Validate;

final class VularMediaSelect extends VInput{
    //use Validate, Fieldable;

    protected $sizes = [];
    public function __construct(){
        parent::__construct();
        //$this->defaultValue([]);
        //$this->pivot('alt_text');
        //$this->pivot('order');
    }   
    
 
    function title($value){
        return $this->props(__FUNCTION__, $value);
    }

    function imageFlexClass($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }

    function blankValue(){
        return [];
    }

    function addSize($size){
        array_push($this->sizes, ['width'=>$size[0],'height'=>$size[1]]);
        return $this;
    }

    function preSave($value){
        foreach ($value as $viewMedia) {
            $media = Media::find($viewMedia->id);
            foreach ($this->sizes as $size) {
                $media->resize($size['width'], $size['height']);
            }
        }
    }


}