<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

class VCard extends VularNode{
    public function __construct(){
        parent::__construct();
        $this->name = 'VCard';
    }   
    function activeClass($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function append(bool $value = true){
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
    
    function elevation($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function exact(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function exactActiveClass($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function flat(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hover(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function href($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function img($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function maxHeight($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function maxWidth($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function minHeight($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function minWidth($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function nuxt(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function raised(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function replace(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function ripple($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function tag($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function target($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function tile(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function to($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function width($value){
        return $this->props(__FUNCTION__, $value);
    }
    
}