<?php
namespace Water\Vular\Core;

class HasOneField extends Field{
    function validate(){
        $errors = [];
        //foreach ($this->fields as $field) {
        //    $errors = array_merge_recursive($errors, $field->validate());
        //}
        return $errors;
    }

    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();
        $this->fieldInput->setModelClass($dbModel->$fieldName()->getModel());
        parent::dbToView($dbModel, $viewModel);
    }

    function saveRelation($viewModel, $dbModel){
        $fieldName = $this->fieldName();
        $modelClass = $dbModel->$fieldName()->getModel();
        //$relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;
        $this->fieldInput->setModelClass($modelClass);

        $relaltionViewModel = $viewModel->$fieldName;
        $relationDbModel = $this->fieldInput->convertToDb($relaltionViewModel);
        //foreach ($this->fields as $field) {
        //    $field->viewToDb($relaltionViewModel, $relationDbModel);
        //}
        $dbModel->$fieldName()->save($relationDbModel);
    }

    function duplicate($viewModel, $targetViewModel){
        $fieldName = $this->fieldName();
        $relaltionViewModel = $viewModel->$fieldName;
        if($relaltionViewModel){
            $targetRelationViewModel = new \stdClass;
            foreach ($this->fieldInput->fields() as $field) {
                $subFieldName = $field->field;
                $targetRelationViewModel->$subFieldName = $relaltionViewModel->$subFieldName;
            }
            $targetViewModel->$fieldName = $viewModel->$fieldName;
        }
    }


}