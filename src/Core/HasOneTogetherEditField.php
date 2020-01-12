<?php
namespace Water\Vular\Core;

class HasOneTogetherEditField extends TogetherEditField{
    function validate(){
        $errors = [];
        foreach ($this->fields as $field) {
            $errors = array_merge_recursive($errors, $field->validate());
        }
        return $errors;
    }

    function saveRelation($viewModel, $dbModel){
        $fieldName = $this->relationName;
        $modelClass = $dbModel->$fieldName()->getModel();
        $relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;

        $relaltionViewModel = $viewModel->$fieldName;

        foreach ($this->fields as $field) {
            $field->viewToDb($relaltionViewModel, $relationDbModel);
        }

        $dbModel->$fieldName()->save($relationDbModel);
    }
}