<?php
namespace Water\Vular\Elements\Relations;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Validate;

use Water\Vular\Elements\Fieldable;

class VularHasManyInput extends VularNode{
    use Fieldable, Validate;
    protected $fields = [];

    function fields(){
        return $this->fields;
        //return $this->formGrid->fields();
    }
    
   
    function blankValue(){
        return [];
    }

    function defaultValue($value, $relation = null){
        $this->defaultValue = $value;
        return $this;
    }

}