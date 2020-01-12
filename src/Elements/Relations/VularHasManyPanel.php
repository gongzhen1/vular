<?php
namespace Water\Vular\Elements\Relations;

final class VularHasManyPanel extends VularHasManyInput{
    public function __construct(){
        parent::__construct();
        $this->props('flexs', []);
    }  
     
    function title($value){
        return $this->props(__FUNCTION__, $value);
    }

    function flex($field, $classes = 'xs12'){
        $flex = new \stdClass;
        $flex->class = $classes . ' pa-2';
        $flex->field = $field;
        array_push($this->fields, $field);
        array_push($this->props->flexs, $flex);
        //$this->formGrid->flex($field, $classes)
        //    ->class('pa-2');
        return $this;

    }

}