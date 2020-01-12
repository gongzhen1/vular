<?php
namespace Water\Vular\Elements;

trait Fieldable {
    protected $_toDbFilter;

    protected $_toViewFilter;

    protected $readOnly = false;

    protected $blankValue;

    function field($field){
        $this->field = $field;
        return $this;
    }

    function preSave($value){

    }
    
    function convertToDb($value){
        return $this->_toDbFilter ? ($this->_toDbFilter)($value) : $value;
    }

    function convertToView($value){
        return $this->_toViewFilter ? ($this->_toViewFilter)($value) : $value;
    }

    function saveFilter($filter){
        $this->_toDbFilter = $filter;
        return $this;
    }

    function showFilter($filter){
        $this->_toViewFilter = $filter;
        return $this;
    }

    function defaultValue($defaultValue, $relation = null){
        $this->defaultValue = $defaultValue ? $defaultValue : $this->blankValue();
        return $this;
    }

    function empertyIngore(bool $value = true){
        $this->empertyIngore = $value;
        return $this;
    }

    function isEmpertyIngore(){
        return property_exists($this, 'empertyIngore') && $this->empertyIngore;
    }

    function bindsTo($panel){
        $this->props('owner', $panel->vularId());
        return $this;
    }

    function setBlankValue($value){
        $this->blankValue = $value;
        return $this;
    }

    function blankValue(){
        return $this->blankValue;
    }

    function readOnly(bool $value = true){
        $this->readOnly = $value;
        return $this;
    }

    function isReadOnly(){
        return $this->readOnly;
    }

}