<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VAlert extends VularNode{

	function color($value){
		return $this->props(__FUNCTION__, $value);
	}

	function dismissible(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function icon($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function mode($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function origin($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function outline($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function transition($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function type($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function value($value){
		return $this->props(__FUNCTION__, $value);
	}
	
}