<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VListGroup extends VularNode{
    function activeClass( $value ){
        return $this->props(__FUNCTION__, $value);
    }
	
    function appendIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function disabled(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function group($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function lazy(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function noAction(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function prependIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function subGroup(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
    function value(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
	
}