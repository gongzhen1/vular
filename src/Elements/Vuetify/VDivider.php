<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VDivider extends VularNode{
	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function inset(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function vertical(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
}