<?php
namespace Water\Vular\Core;

class TogetherEditField extends Field{
    protected $relationName;

    protected $fields = [];
    
    public function __construct($fieldInput, $modelName, $relationName, $subFieldName){
        parent::__construct(null, $modelName);
        $this->relationName = $relationName;

        $this->addField($subFieldName, $fieldInput);
    }

    function fieldName(){
        return $this->relationName;
    }

    function viewModel($viewModel){
        $relationName = $this->relationName;
        foreach ($this->fields as $field) {
            $field->viewModel($viewModel->$relationName);
        }
        $this->viewModel = $viewModel;
    }

    function addField($fieldName, $fieldInput){
        $modelName = $this->modelName;
        $dbModel = new $modelName();
        $relationName = $this->relationName;
        $relationModelName = $dbModel->$relationName()->getModel();
        array_push($this->fields, new AttributeField($fieldInput, $relationModelName));
    }

    //function subFieldName($fieldName){
    //    $pos = strpos($fieldName,'.');
    //    return substr($fieldName, $pos+1);
    //}
    function dbToView($dbModel, $viewModel){
        $fieldName = $this->relationName;

        $modelClass = $dbModel->$fieldName()->getModel();
        
        $relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;

        $relaltionViewModel = new \stdClass;
        foreach ($this->fields as $field) {
            $subFieldName = $field->fieldName();
            $fullFieldName = $this->relationName.'.'.$subFieldName;
            $field->dbToView($relationDbModel, $relaltionViewModel);
            $viewModel->$fullFieldName = $relaltionViewModel->$subFieldName;
        }

        $relaltionViewModel->id = $relationDbModel->id;

        $viewModel->$fieldName = $relaltionViewModel;
    }

    function viewToDb($viewModel, $dbModel){
    }

    function duplicate($viewModel, $targetViewModel){
        $fieldName = $this->relationName;
        //$modelClass = $dbModel->$fieldName()->getModel();
        //$relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;

        $relaltionViewModel = $viewModel->$fieldName;

        foreach ($this->fields as $field) {
            $subFieldName = $field->fieldName();
            $relaltionViewModel->$subFieldName =  $viewModel->$fieldName->$subFieldName;
        }
        $targetViewModel->$fieldName = $relaltionViewModel;
    }

}