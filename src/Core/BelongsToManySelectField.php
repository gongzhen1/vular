<?php
namespace Water\Vular\Core;

//界面输入ID数组
//从数据库取出对象列表，转成ID数组传给界面，可以附带pivot数据
class BelongsToManySelectField extends Field{

    function dbToView($dbModel, $viewModel){
        $fieldName = $this->fieldName();
        $viewModel->$fieldName = $dbModel->id ? $this->fieldInput->convertToView($dbModel->$fieldName) : $this->fieldInput->blankValue();
        $this->fieldInput->defaultValue($viewModel->$fieldName);
        //\Log::notice(json_encode($viewModel->$fieldName));
    }

    function saveRelation($viewModel, $dbModel){
        $relationName = $this->fieldInput->field;
        $relations = $this->parseIdsAndPivots($this->viewValue);

        $dbModel->$relationName()->sync($relations);
        //$this->fieldInput->save($this->value, $this->relationName);
    }

    function duplicate($viewModel, $targetViewModel){
        $fieldName = $this->fieldName();
        $targetViewModel->$fieldName = $viewModel->$fieldName;
        foreach ($targetViewModel->$fieldName as $item) {
            if($item instanceof \stdClass){
                $item->pivot = null;
            }
        }

        //\Log::notice(json_encode($targetViewModel->$fieldName));
    }

    protected function parseIdsAndPivots($items){
        $ids = [];
        if($items){
            foreach ($items as $item) {
                $this->parseIdAndPivot($item, $ids);
            }
        }
        //\Log::notice(json_encode($items));
        //\Log::notice(json_encode($ids));
        return $ids;
    }

    protected function parseIdAndPivot($item, &$ids){
        if($item instanceof \stdClass && property_exists($item, 'id')){
            if(property_exists($item, 'pivot') && $item->pivot){
                $ids[$item->id] = json_decode(json_encode($item->pivot), true);
            }
            else{
                array_push($ids, $item->id);
            }
        }
        else{
            array_push($ids, $item);
        }
    }

}