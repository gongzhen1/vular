<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\ActionAble;

final class VSpeedDial extends VularNode{
	function absolute(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function activeClass($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function append(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function block(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function bottom(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function color($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function dark(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function depressed(bool $value = true){
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
	
	function fab(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function fixed(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function flat(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function href($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function icon(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function inputValue($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function large(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function left(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function light(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function loading(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function nuxt(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function outline(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function replace(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function right(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function ripple($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function round(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function small(bool $value = true){
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
	
	function top(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function type($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function value($value){
		return $this->props(__FUNCTION__, $value);
	}

	function valid($value ='vularValid'){
		$this->validField = $value;
		return $this;
	}
	
}