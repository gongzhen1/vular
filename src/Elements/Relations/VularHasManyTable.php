<?php
namespace Water\Vular\Elements\Relations;

final class VularHasManyTable extends VularHasManyInput{
    public function __construct(){
        parent::__construct();
        $this->props('flexs', []);
        $this->newTitle('添加条目');
        $this->editTitle('编辑条目');
        $this->editDialogWidth('600px');
    }   
    
    function title($value){
        return $this->props(__FUNCTION__, $value);
    }

    function newTitle($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function editTitle($value){
        return $this->props(__FUNCTION__, $value);
    }
   

    function editDialogWidth($value){
        return $this->props(__FUNCTION__, $value);
    }

    function flex($field, $classes = 'xs12'){
        $flex = new \stdClass;
        $flex->class = $classes . ' pa-2';
        $flex->field = $field;
        array_push($this->fields, $field);
        array_push($this->props->flexs, $flex);
        return $this;

    }


}