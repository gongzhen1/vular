<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VCheckbox extends VularNode{
    use Validate, Fieldable ;

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
    
    function falseValue($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hideDetails(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function id($value){
        return $this->props(__FUNCTION__, $value);
    }

    function indeterminate(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function indeterminateIcon($value){
        return $this->props(__FUNCTION__, $value);
    }

    function inputValue(bool $value = true){
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
    
    function messages($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function multiple(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function offIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function OnIcon($value){
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
    
    function ripple($value){
        return $this->props(__FUNCTION__, $value);
    }
    

    function success(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function successMessages($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function trueValue($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function validateOnBlur(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function valueComparator($value){
        return $this->props(__FUNCTION__, $value);
    }

    function defaultValue(){
        return false;
    }

}