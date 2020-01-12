<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VList extends VularNode{

    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function dense(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function expand(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function subheader(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function threeLine(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function twoLine(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
}