<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VListTileAvatar extends VularNode{

    function color($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function size($value){
        return $this->props(__FUNCTION__, $value);
    }
	
    function tile($value){
        return $this->props(__FUNCTION__, $value);
    }
	
}