<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VBadge extends VularNode{
	function bottom(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function color($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function left(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function mode($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function origin($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function overlap(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function right(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function transition($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function value($value){
		return $this->props(__FUNCTION__, $value);
	}
	
}