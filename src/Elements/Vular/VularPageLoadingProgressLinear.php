<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

final class VularPageLoadingProgressLinear extends VularNode{

	function active(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function backgroundColor($value){
		return $this->props(__FUNCTION__, $value);
	}

	function backgroundOpacity($value){
		return $this->props(__FUNCTION__, $value);
	}

	function bufferValue($value){
		return $this->props(__FUNCTION__, $value);
	}

	function color($value){
		return $this->props(__FUNCTION__, $value);
	}

	function height($value){
		return $this->props(__FUNCTION__, $value);
	}

	function indeterminate( bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function query(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function value($value){
		return $this->props(__FUNCTION__, $value);
	}
}