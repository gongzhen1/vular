<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VIcon extends VularNode{
	function color($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function disabled(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function large(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function left(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function medium(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function right(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function size($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function small(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function xLarge(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
}