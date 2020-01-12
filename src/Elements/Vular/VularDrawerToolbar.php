<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

final class VularDrawerToolbar extends VularNode{

	function title($value){
		return $this->props(__FUNCTION__, $value);
	}

	function logo($value){
		return $this->props(__FUNCTION__, $value);
	}

	function showMiniButton(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function color($value){
		return $this->props(__FUNCTION__, $value);
	}

	function href($value){
		return $this->props(__FUNCTION__, $value);
	}

	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function light($value){
		return $this->props(__FUNCTION__, $value);
	}

	function drawerMini(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
}