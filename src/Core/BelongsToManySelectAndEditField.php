<?php
namespace Water\Vular\Core;

//界面输入对象数组
//负责编辑对象数组，没有删除功能，并进行关联
class BelongsToManySelectAndEditField extends BelongsToManySelectField{

    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();
        $viewModel->$fieldName = $dbModel->id ? $this->fieldInput->convertToView($dbModel->$fieldName?$dbModel->$fieldName:[] ) : $this->fieldInput->blankValue();
        $this->fieldInput->defaultValue($viewModel->$fieldName);
        //\Log::notice(json_encode($viewModel->$fieldName));
    }

    function saveRelation($viewModel, $dbModel){
    	$relationName = $this->fieldInput->field;
        $dbSubModels = $this->fieldInput->convertToDb($this->viewValue, $dbModel->$relationName()->getModel());
        $ids = [];
        if($dbSubModels){
            foreach ($dbSubModels as $dbSubModel) {
                $dbSubModel->save();
                array_push($ids, $dbSubModel->id);
            }
        }
    	//\Log::notice(json_encode($this->viewValue));

        //关联
    	$dbModel->$relationName()->sync($ids);
        //$this->fieldInput->save($this->value, $this->relationName);
    }


}