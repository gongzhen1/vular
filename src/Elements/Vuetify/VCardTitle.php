<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;

final class VCardTitle extends VularNode{
    function primaryTitle(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
}