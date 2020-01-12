<?php
namespace Water\Vular\Core;

class AttributeField extends Field{
    function validate(){
        $errors = [];
        $errors = array_merge_recursive($errors, $this->checkUnique());
        if(method_exists($this->fieldInput, 'doValidate')){
            $validateResult = $this->fieldInput->doValidate();
            if($validateResult){
                $errors = array_merge_recursive($errors, $validateResult);
            }
        }

        return $errors;
    }

    function checkUnique(){
        $errors = [];
        $fieldName = $this->fieldName();
        if(property_exists($this->fieldInput, 'unique') && $this->fieldInput->unique){
            $duplicateModel = $this->modelName::where($fieldName, $this->viewValue)->first();
            $id = $this->viewModel && property_exists($this->viewModel, 'id') ? $this->viewModel->id : null;
            if($duplicateModel && $duplicateModel->id != $id){
                //$validated = false;
                $msg = str_replace('{0}', $this->fieldInput->props->label, trans('vular.duplicate'));
                array_push($errors, ['field'=>$this->fieldInput->field, 'message'=>$msg]);
            }
        //\Log::notice(json_encode($this->viewModel));
        }
        return $errors;
    }

    function viewToDb($viewModel, $dbModel){
        $fieldName = $this->fieldName();
        $value = $viewModel && property_exists($viewModel, $fieldName) ? $viewModel->$fieldName : null;
        if(!$this->fieldInput->isEmpertyIngore() || $value){
            $dbModel->$fieldName = $this->fieldInput->convertToDb($value);
            //$this->dbValue = $dbModel->$fieldName;
        }
    }


}