<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;

final class VularDataTableFilter extends VularNode{
    use Fieldable;
    public function __construct(){
        parent::__construct();
        $this->props('vularId', uniqid('vid'));
        $this->defaultValue(new \stdClass);
    }

    function vularId(){
        return $this->props->vularId;
    }

    function activatorText($value){
        return $this->props(__FUNCTION__, $value);
    }

    function title($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function clearText($value){
        return $this->props(__FUNCTION__, $value);
    }

    function confirmText($value){
        return $this->props(__FUNCTION__, $value);
    }

    //function value($value){
   //     return $this->props(__FUNCTION__, $value);
    //}

    function blankValue(){
        return new \stdClass;
    }

}