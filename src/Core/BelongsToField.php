<?php
namespace Water\Vular\Core;

class BelongsToField extends Field{
    function viewToDb($viewModel, $dbModel){
        $fieldName = $this->fieldName();
        //\Log::notice(json_encode($viewModel->$fieldName));
        if($viewModel){
            $value = $this->fieldInput->convertToDb($viewModel->$fieldName);
            $modelName = get_class($dbModel->$fieldName()->getQuery()->getModel());
            $relationObj = $modelName::find($value instanceof \stdClass ? $value->id : $value);
            $dbModel->$fieldName()->associate($relationObj);
        }
    }

    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();
        $viewModel->$fieldName = $dbModel->id ? $this->fieldInput->convertToView($dbModel->$fieldName) : $this->fieldInput->blankValue();
        if($viewModel){
            $this->fieldInput->defaultValue($viewModel->$fieldName);
        }
        //\Log::notice(json_encode($viewModel));
    }


}