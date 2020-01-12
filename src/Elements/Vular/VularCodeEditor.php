<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VularCodeEditor extends VularNode{
    use Validate, Fieldable ;
   
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
   
}