<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

class VLayout extends VularNode{
    public function __construct(){
        parent::__construct();
        $this->name = 'VLayout';
    }   

	function alignBaseline(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function alignCenter(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function alignContentCenter(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignContentEnd(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignContentSpaceAround(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignContentSpaceBetween(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignContentStart(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignEnd(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignStart(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function column(bool $value = true){
		return $this->class(__FUNCTION__, $value);
	}

	function fillHeight(){
		return $this->props(__FUNCTION__, $value);
	}
	
	function id($value){
		return $this->props(__FUNCTION__, $value);
	}
	
	function justifyCenter(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function justifyEnd(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function justifySpaceAround(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function justifySpaceBetween(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function justifyStart(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function reverse($value){
		return $this->props(__FUNCTION__);
	}

	function row(bool $value = true){
		return $this->class(__FUNCTION__, $value);
	}
	function tag($value){
		return $this->props(__FUNCTION__, $value);
	}
	function wrap(bool $value = true){
		return $this->class(__FUNCTION__, $value);
	}
}