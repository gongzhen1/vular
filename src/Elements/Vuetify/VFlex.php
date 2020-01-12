<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VFlex extends VularNode{
    /**
     * xs: extra small
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function xs($size){
		return $this->class(__FUNCTION__.$size, true);
	}
    /**
     * sm: small
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function sm($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * md: medium
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function md($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * lg: large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function lg($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * xl: extra large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function xl($size){
		return $this->class(__FUNCTION__.$size, true);
	}


	function alignSelfBaseline(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}

	function alignSelfCenter(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignSelfEnd(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function alignSelfStart(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function grow(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
	function id(){
		return $this->props(__FUNCTION__, $value);
	}
	
    /**
     * offset-xs-{size}: extra small
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function offsetXs($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * offset-sm-{size}: small
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function offsetSm($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * offset-md-{size}: medium
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function offsetMd($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * offset-lg-{size}: large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function offsetLg($size){
		return $this->class(__FUNCTION__.$size, true);
	}
	
    /**
     * offset-xl-{size}: extra large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function offsetXl($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * order-sm-{size}: small
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function orderSm($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * order-md-{size}: medium
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function orderMd($size){
		return $this->class(__FUNCTION__.$size, true);
	}

    /**
     * order-lg-{size}: large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function orderLg($size){
		return $this->class(__FUNCTION__.$size, true);
	}
	
    /**
     * order-xl-{size}: extra large
     *
     * @param  number  $size 1 through 12
     * @return void
     */
	function orderXl($size){
		return $this->class(__FUNCTION__.$size, true);
	}

	function shrink($value = true){
		return $this->props(__FUNCTION__, $value, true);
	}

	function tag($value){
		return $this->props(__FUNCTION__, $value, true);
	}
	
}