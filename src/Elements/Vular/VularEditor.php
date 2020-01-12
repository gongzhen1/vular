<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VularEditor extends VularNode{
	 use Validate, Fieldable;
	function label($value){
		return $this->props(__FUNCTION__, $value);
	}
	function width($value){
		return $this->props(__FUNCTION__, $value);
	}
	function height($value){
		return $this->props(__FUNCTION__, $value);
	}

}