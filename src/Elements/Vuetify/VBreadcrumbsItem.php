<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VBreadcrumbsItem extends VularNode{
	function activeClass($value){
		return $this->props(__FUNCTION__, $value);
	}

	function append(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function disabled(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function exact(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function exactActiveClass($value){
		return $this->props(__FUNCTION__, $value);
	}

	function href($value){
		return $this->props(__FUNCTION__, $value);
	}

	function nuxt(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function replace(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function ripple($value){
		return $this->props(__FUNCTION__, $value);
	}

	function tag($value){
		return $this->props(__FUNCTION__, $value);
	}

	function target($value){
		return $this->props(__FUNCTION__, $value);
	}

	function to($value){
		return $this->props(__FUNCTION__, $value);
	}
	
}