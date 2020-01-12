<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Validate;
use Water\Vular\Elements\Fieldable;

final class VSlider extends VularNode{
    use Validate, Fieldable;

    function alwaysDirty(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function appendIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendOuterIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function backgroundColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function color($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function disabled(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function error(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function errorCount($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function errorMessages($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hideDetails(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hint($value){
        return $this->props(__FUNCTION__, $value);
    }

    function inverseLabel(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
 
    function label($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function loading(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function max($value){
        return $this->props(__FUNCTION__, $value);
    }

    function messages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function min($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function persistentHint(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
   
    function prependIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependIconCb(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function readonly(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function step($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function success(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function successMessages($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function thumbColor($value){
        return $this->props(__FUNCTION__, $value);
    }

    function thumbLabel($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function thumbSize($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function tickLabels($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function tickSize($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function ticks(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function trackColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function validateOnBlur(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }

}