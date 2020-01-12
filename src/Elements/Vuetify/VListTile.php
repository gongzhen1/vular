<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\RouteAble;

final class VListTile extends VularNode{
    function activeClass($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function append(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function avatar(bool $value = true){
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
	
    function exact(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function exactActiveClass($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function href($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function inactive(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function nuxt(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function replace(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function ripple( $value = true ){
        return $this->props(__FUNCTION__, $value);
    }
	
    function tag( $value ){
        return $this->props(__FUNCTION__, $value);
    }
	
    function target($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function to($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }

    //推测添加
    function rel($value){
        return $this->props(__FUNCTION__, $value);
    }

    
	
}