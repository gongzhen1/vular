<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

final class VularDrawer extends VularNode{
    function clipped($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function disableRouteWatcher($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function disableResizeWatcher($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function height($value){
        return $this->props(__FUNCTION__, $value);
    }

    function floating($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function miniVariant($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function miniVariantWidth($value){
        return $this->props(__FUNCTION__, $value);
    }

    function mobileBreakPoint($value){
        return $this->props(__FUNCTION__, $value);
    }

    function permanent($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function right($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function stateless($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function temporary($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function touchless($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function width($value){
        return $this->props(__FUNCTION__, $value);
    }

    function app($value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function dark($value = true){
        return $this->props(__FUNCTION__, $value);
    }
    function light($value = true){
        return $this->props(__FUNCTION__, $value);
    }


    function hideOverlay($value = true){
        return $this->props(__FUNCTION__, $value);
    }

}