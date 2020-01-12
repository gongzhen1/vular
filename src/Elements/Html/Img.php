<?php
namespace Water\Vular\Elements\Html;

use Water\Vular\Elements\VularNode;

class Img extends VularNode{
    function alt($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function src($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function align($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function border($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function height($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function hspace($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function ismap($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function longdesc($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function usemap($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function vspace($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
    function width($value){
        return $this->attrs(__FUNCTION__, $value);
    }
    
}