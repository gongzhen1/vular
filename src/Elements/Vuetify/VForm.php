<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VForm extends VularNode{
    function lazyValidation(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function field($field = 'vularValid'){
        $this->field = $field;
        return $this;
    }

}