<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

class VContainer extends VularNode{

    public function __construct(){
        parent::__construct();
        $this->name = getbase(__CLASS__);
    }

    function alignBaseline(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function alignCenter(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function alignContentCenter(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignContentEnd(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignContentSpaceAround(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignContentSpaceBetween(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignContentStart(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignEnd(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function alignStart(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function fillHeight(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function fluid(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function gridListXs(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function gridListSm(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function gridListMd(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function gridListLg(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function gridListXl(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function id($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function justifyCenter(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function justifyEnd(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function justifySpaceAround(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function justifySpaceBetween(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function justifyStart(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function tag($value){
        return $this->props(__FUNCTION__, $value);
    }
}