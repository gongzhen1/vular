<?php
namespace Water\Vular\Core;

class Field{

    //private $fieldName;

    protected $fieldInput;

    //private $isRelation = false;

    protected $modelName;

    //private $relationName;

    protected $dbValue;

    protected $viewValue;

    protected $viewModel;

    protected $fieldName;

    public function __construct($fieldInput, $modelName){
        $this->modelName = $modelName;
        $this->fieldInput = $fieldInput;
        $this->fieldName = $fieldInput ? $this->subFieldName($fieldInput->field) : null;
    }

    function subFieldName($fieldName){
        $pos = strpos($fieldName,'.');
        return $pos > 0 ? substr($fieldName, $pos+1) : $fieldName;
    }

    function fieldName(){
        return $this->fieldName;
    }

    function fieldInput(){
        return $this->fieldInput;
    }

    function fullFieldName(){
        return $this->fieldInput->field;
    }

    function viewModel($viewModel){
        $fieldName = $this->fieldName();
        if($viewModel && property_exists($viewModel, $fieldName)){
            $this->viewValue = $viewModel->$fieldName;
        }
        $this->viewModel = $viewModel;
    }

    function dbModel($dbModel){
        $fieldName = $this->fieldName();
        $this->dbValue = $dbModel->$fieldName;
    }

    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();
        $viewModel->$fieldName = $dbModel->id ? $this->fieldInput->convertToView($dbModel->$fieldName ) : $this->fieldInput->blankValue();
        $this->fieldInput->defaultValue($viewModel->$fieldName);
        //\Log::notice(json_encode($fieldName));
        //\Log::notice(json_encode($viewModel->$fieldName));
    }

    function duplicate($viewModel, $targetViewModel){
        $fieldName = $this->fieldName();
        $targetViewModel->$fieldName = $viewModel->$fieldName;
    }

    function viewToDb($viewModel, $dbModel){
    }

    function validate(){
        $errors = [];
        return $errors;
    }

    function preSave($viewModel, $dbModel){
        $fieldName = $this->fieldName();
        $this->fieldInput()->preSave($viewModel->$fieldName);
    }

    function saveRelation($viewModel, $dbModel){

    }
    //function relationName(){
    //    return $this->relationName;
    //}


}