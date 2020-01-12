<?php
namespace Water\Vular\Core;

class HasManyField extends Field{
    function saveRelation($viewModel, $dbModel){
        $fieldName = $this->fieldName();
        //删除需要删的
        foreach ($dbModel->$fieldName as $relationModel) {
            if($this->isNeedDelete($relationModel->id)){
                $relationModel->delete();
            }
        }

        //增加需要增加的,修改需要修改的
        foreach ($this->viewModel->$fieldName as $relationViewModel) {
            $modelClass = $dbModel->$fieldName()->getModel();
            $id = property_exists($relationViewModel, 'id') ? $relationViewModel->id : null;
            //$relationViewModel->id = null;
            $formModel = new FormModel($this->fieldInput->fields(), $modelClass, $id);
            $formModel->viewModel($relationViewModel);
            $relationModel = $formModel->getDbModel(); 
            if($id){
                $relationModel->save();
            }
            else{
                $dbModel->$fieldName()->save($relationModel);
            }
        }
    }

    function isNeedDelete($id){
        $fieldName = $this->fieldName();
        foreach ($this->viewModel->$fieldName as $relationViewModel) {
            if(property_exists($relationViewModel, 'id') && $id == $relationViewModel->id){
                return false;
            }
        }
        return true;
    }


    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();

        $relations = [];
        foreach ($dbModel->$fieldName as $relationDbModel) {
            $modelClass = $dbModel->$fieldName()->getModel();
            $formModel = new FormModel($this->fieldInput->fields(), $modelClass, $relationDbModel->id);
            array_push($relations, $formModel->getViewModel());
        }

        $viewModel->$fieldName = $relations;

        $this->fieldInput->defaultValue($relations);
        //\Log::notice(json_encode($this->fieldInput));
    }

    function duplicate($viewModel, $targetViewModel){
        $fieldName = $this->fieldName();
        if($viewModel->$fieldName){
            $targetViewModel->$fieldName = [];
            foreach ($targetViewModel->$fieldName as $key => $item) {
                $targetItem = new \stdClass;
                $targetViewModel->$fieldName[$key] = $targetItem;
                foreach ($this->fieldInput->fields() as $field) {
                    $subFieldName = $field->field;
                    $targetItem->$subFieldName = $item->$subFieldName;
                }

            }

        }
    }

}