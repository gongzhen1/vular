<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VRadio extends VularNode{
    use Validate, Fieldable ;

    function color($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
     function disabled(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function label($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    function offIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function onIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function readonly(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function ripple($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }

    function blankValue(){
        return false;
    }
    
}