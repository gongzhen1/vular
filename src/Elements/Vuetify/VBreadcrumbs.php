<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VBreadcrumbs extends VularNode{
	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function divider($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function items($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function large(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
}