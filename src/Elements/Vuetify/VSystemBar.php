<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VSystemBar extends VularNode{
    function absolute(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function app(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function color($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function fixed(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function lightsOut(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function status(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function window(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    

}