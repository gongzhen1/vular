<?php
namespace Water\Vular\Elements\Vular;

class VularTablePagination{

    public function __construct(){
        $this->sortBy = '';
        $this->descending = false;
        $this->rowsPerPage = 10;
    }
    static function make(){
        return new VularTablePagination();
    }

    function descending(bool $value = true){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function page($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function rowsPerPage($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function sortBy($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
    function totalItems($value){
        $name = __FUNCTION__;
        $this->$name = $value;
        return $this;
    }
    
}