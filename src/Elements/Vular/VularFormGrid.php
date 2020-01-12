<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\MakeAble;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;

class VularFormGrid extends VLayout{
    protected $fields = [];


    function flex($field, $classes = 'xs12'){
        array_push($this->fields, $field);
        $flex = VFlex::make()
            ->class($classes)
            ->children($field);
        $this->row()->wrap();
        $this->children($flex);

        return $flex;
    }

    function fields(){
        return $this->fields;
    }
}

