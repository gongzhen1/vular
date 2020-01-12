<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;

final class VularLabel extends VularNode{
    use Fieldable;
    public function __construct(){
        parent::__construct();
        $this->readOnly();
    }  

    function maxLength($value){
        return $this->props(__FUNCTION__, $value);
    }

    function ellipsisSymbol($value){
        return $this->props(__FUNCTION__, $value);
    }

}