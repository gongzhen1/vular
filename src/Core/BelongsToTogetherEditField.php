<?php
namespace Water\Vular\Core;

class BelongsToTogetherEditField extends TogetherEditField{

    function validate(){
        $errors = [];
        foreach ($this->fields as $field) {
            $errors = array_merge_recursive($errors, $field->validate());
        }
        return $errors;
    }

    /*function dbToView($dbModel, $viewModel){
        $fieldName = $this->relationName;

        $modelClass = $dbModel->$fieldName()->getModel();
        
        $relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;

        $relaltionViewModel = new \stdClass;
        foreach ($this->fields as $field) {
            $subFieldName = $field->fieldName();
            $fullFieldName = $relationDbModel.'.'.$subFieldName;
            $field->dbToView($relationDbModel, $relaltionViewModel);
        }

        $relaltionViewModel->id = $relationDbModel->id;

        $viewModel->$fieldName = $relaltionViewModel;
    }*/


    function preSave($viewModel, $dbModel){
        parent::preSave();
        $fieldName = $this->relationName;
        $modelClass = $dbModel->$fieldName()->getModel();
        $relationDbModel = $dbModel->$fieldName ? $dbModel->$fieldName : new $modelClass;

        $relaltionViewModel = $viewModel->$fieldName;

        foreach ($this->fields as $field) {
            $field->viewToDb($relaltionViewModel, $relationDbModel);
        }

        $relationDbModel->save();
        $dbModel->$fieldName()->associate($relationDbModel);
    }


}