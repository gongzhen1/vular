<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VularSlug extends VularNode{
    use Validate, Fieldable ;

    function appendIcon($value){
        return $this->props(__FUNCTION__, $value);
    }

    function appendIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendOuterIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendOuterIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
 
    function autofocus(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function backgroundColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function box(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function browserAutocomplete($value){
        return $this->props(__FUNCTION__, $value);
    }

    function clearIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function clearIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }

    function clearable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function color($value){
        return $this->props(__FUNCTION__, $value);
    }

    function counter($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function disabled(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function dontFillMaskBlanks(bool $value = true){
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

    function flat(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function fullWidth(bool $value = true){
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

    function label($value){
        return $this->props(__FUNCTION__, $value);
    }

    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function loading(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function mask($value){
        return $this->props(__FUNCTION__, $value);
    }

    function messages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function outline(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function persistentHint(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function placeholder($value){
        return $this->props(__FUNCTION__, $value);
    }

    function prefix($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependIconCb(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependInnerIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependInnerIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }

    function readonly(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function returnMaskedValue(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function reverse(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function rows( $value ){
        return $this->props(__FUNCTION__, $value);
    }
    
    function singleLine(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function solo(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function soloInverted(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function success(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function successMessages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function suffix($value){
        return $this->props(__FUNCTION__, $value);
    }

    function type($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function validateOnBlur(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
   
}