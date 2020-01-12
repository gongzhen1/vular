<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VAvatar extends VularNode{
	function color($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function size($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function tile(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
}