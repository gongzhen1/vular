<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\NodeData;
use Water\Vular\Elements\Authable;

class VularTableColumn{
    use Authable;

    static function make($field = null, $text = null){
        $self = new VularTableColumn();
        $self->text($text);
        $self->value($field);
        $self->sortable(false);
        $self->searchable(false);
        return $self;
    }

    function text($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function align($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function sortable(bool $value = true){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    function searchable(bool $value = true){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function field($value){
        return $this->value($value);
    }


    //跟上面的方法同样的作用，只是为了跟Vuetify命名一致
    function value($value){
        $this->value = $value;
        $this->field = $value;
        return $this;
    }
    
    function class($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }

    function width($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    //function styles($value){
    //    return $this->prop('style', $value);
    //}
    
    function prop($name, $value){
        if(!property_exists($this,'props')){
            $this->props = new NodeData;
        }
        $this->props->add($name, $value);

        return $this;
    }
    


}