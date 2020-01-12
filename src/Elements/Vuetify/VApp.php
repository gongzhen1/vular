<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VApp extends VularNode{

	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function id($value){
		return $this->props(__FUNCTION__, $value);
	}

	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
}