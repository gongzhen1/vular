<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

final class VularTiptapEditor extends VularNode{
    use Validate, Fieldable ;

    function errorMessages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function error(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function errorCount($value){
        return $this->props(__FUNCTION__, $value);
    }

}