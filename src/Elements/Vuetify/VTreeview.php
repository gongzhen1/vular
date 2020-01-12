<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VTreeview extends VularNode{
    use Fieldable ;
    function activatable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function active($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function activeClass($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function expandIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hoverable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function indeterminateIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemChildren($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemKey($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemText($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function items($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function loadChildren($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function loadingIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function multipleActive(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function offIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function onIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function open($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function openAll(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function openOnClick(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function selectable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function selectedColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function transition(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
    
}