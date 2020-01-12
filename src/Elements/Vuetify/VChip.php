<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VChip extends VularNode{
	function close(bool $value = true){
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
	
	function label(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function outline(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function selected(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function small(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function textColor($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function value($value){
		return $this->props(__FUNCTION__, $value);
	}

}