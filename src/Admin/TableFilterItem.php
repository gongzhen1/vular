<?php
namespace Water\Vular\Admin;

use Water\Vular\VularAble;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;

class TableFilterItem implements VularAble{

    public $flex;
    protected $input;
    protected $operator;
    protected $like;
    protected $owner;

    public function __construct($owner){
        $this->owner = $owner;
        $this->flex = VFlex::make();
    }

    static public function make($owner){
        return new TableFilterItem($owner);
    }

    function defaultValue()
    {
        return $this->input->defaultValue();
    }

    function toVular(){
        return $this->flex->children($this->input);
    }

    function toExpression($viewModel){
        if(!property_exists($viewModel,$this->input->field)){
            return null;
        }
        $fieldName = $this->input->field;
        $value = $viewModel->$fieldName;

        if($value== null) return null;

        $value = $this->like? str_replace('{0}', $value, $this->like) : $value;
        return [$this->field, $this->operator, $value];
    }

    function input($input){
        $this->input = $input;
        $this->input->bindsTo($this->owner);
        return $this;
    }

    function field($value){
        $this->field = $value;
        return $this;
    }

    function min(){
        $this->operator = '>=';
        return $this;
    }

    function max(){
        $this->operator = '<=';
        return $this;
    }

    function in(){
        $this->operator = 'in';
        return $this;
    }

    function like($like){
        $this->operator = 'like';
        $this->like = $like;
        return $this;
    }
    function equal(){
        $this->operator = '=';
        return $this;
    }
    function notEqual(){
        $this->operator = '<>';
        return $this;
    }

    function fullWidth(){
        $this->flex->md(12);
        return $this;
    }

    function halfWidth(){
        $this->flex->md(6);
        return $this;
    }

    function oneThirdWidth(){
        $this->flex->md(4);
        return $this;
    }

    function oneForthWidth(){
        $this->flex->md(3);
        return $this;
    }

    function oneFifthWidth(){
        $this->flex->md(2);
        return $this;
    }


}