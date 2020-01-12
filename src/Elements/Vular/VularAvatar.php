<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;
use Water\Vular\Models\Media;

final class VularAvatar extends VularNode{
     use Validate, Fieldable;
    protected $sizes = [];

    function label($value){
        return $this->props(__FUNCTION__, $value);
    }
    function width($value){
        return $this->props(__FUNCTION__, $value);
    }
    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    function mediaType($value){
        return $this->props(__FUNCTION__, $value);
    }

    //function blankValue(){
    //    return null;
    //}

    function convertToDb($value){
        if($value instanceof \stdClass){
            if(property_exists($value, 'id')){
                $value = $value->id;
            }
            else{
                $value = null;
            }
        }
        return $this->_toDbFilter ? ($this->_toDbFilter)($value) : $value;
    }


    function addSize($size){
        array_push($this->sizes, ['width'=>$size[0],'height'=>$size[1]]);
        return $this;
    }

    function preSave($value){

        if($value){
            $media = Media::find($value->id);
            if($media){
                foreach ($this->sizes as $size) {
                   $media->resize($size['width'], $size['height']);
                }
            }
            
        }
    }

}