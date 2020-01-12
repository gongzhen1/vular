<?php
namespace Water\Vular\Core;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormModel{

	private $fields = [];
    privAte $readOnlyFields = [];

	private $modelName;
	private $id;
	private $viewModel;
    private $dbModel;

	public function __construct($fieldInputs, $modelName, $id){
		$this->modelName = $modelName;
		$this->id = $id;

		foreach ($fieldInputs as $input) {
			$this->makeField($input);
		}
	}

    function save(){
        $dbModel = $this->getDbModel();
        $this->preSave($this->viewModel, $dbModel);
        $dbModel->save();
        $this->saveRelations($this->viewModel);
    }


    function makeField($fieldInput){
        $fieldName = $fieldInput->field;
        $dbModel = new $this->modelName;
        if($fieldInput->isReadOnly()){
            array_push($this->readOnlyFields, $fieldInput);
        }
        else if(method_exists($dbModel, $fieldName)){
            $relation = $dbModel->$fieldName();
            if($relation instanceof BelongsToMany){
                $this->fields[$fieldName] = 
                    method_exists($fieldInput, 'isWithEdit') && $fieldInput->isWithEdit() ? 
                    new BelongsToManySelectAndEditField($fieldInput, $this->modelName) :
                    new BelongsToManySelectField($fieldInput, $this->modelName);
            }
            if($relation instanceof BelongsTo){
                $this->fields[$fieldName] = new BelongsToField($fieldInput, $this->modelName);
            }
            if($relation instanceof HasMany){
                $this->fields[$fieldName] = new HasManyField($fieldInput, $this->modelName);
            }
            if($relation instanceof HasOne){
                $this->fields[$fieldName] = new HasOneField($fieldInput, $this->modelName);
            }
        }
        else if(!$this->makeTogetherEditOneToOneField($fieldInput)){
        	 $this->fields[$fieldName] = new AttributeField($fieldInput, $this->modelName);
        }

    }

    function makeTogetherEditOneToOneField($fieldInput){
        $fieldName = $fieldInput->field;
        $dbModel = new $this->modelName;
        $pos = strpos($fieldName,'.');
        if($pos > 0){
            $relationName = substr($fieldName, 0, $pos);
            $subFieldName =  substr($fieldName, $pos+1);
            if(method_exists($dbModel, $relationName)){
                $relation = $dbModel->$relationName();
                if(array_key_exists($relationName, $this->fields) && $this->fields[$relationName]){
                	$this->fields[$relationName]->addField($subFieldName, $fieldInput);
                	return true;
                }
                else if($relation instanceof HasOne){
               		$this->fields[$relationName] = new HasOneTogetherEditField($fieldInput, $this->modelName, $relationName, $subFieldName);
                	return true;
                }
                else if($relation instanceof BelongsTo){
                	$this->fields[$relationName] = new BelongsToTogetherEditField($fieldInput, $this->modelName, $relationName, $subFieldName);
                	return true;
                }
            	throw new VularException('Field ' . $fieldName .' is not correct in ' . $this->modelName);
            }

            throw new VularException('Field ' . $fieldName .' can not be found in ' . $this->modelName);
        }

        return false;
    }

    function getViewModel(){
    	$this->viewModel = $this->viewModel ? $this->viewModel : $this->resolveViewModel();
        return $this->viewModel;
    }

    function viewModel($viewModel){
    	$this->viewModel = $viewModel;
        foreach ($this->fields as $field) {
            $field->viewModel($viewModel);
        }
    }

    function getDbModel(){
        $this->dbModel = $this->dbModel ? $this->dbModel : $this->resolveDbModel();
        return $this->dbModel;
    }
    
    function duplicate($viewModel){
        $targetViewModel = new \stdClass;
        $targetViewModel->id = null;

        foreach ($this->fields as $field) {
            $field->duplicate($viewModel, $targetViewModel);
        }

        return $targetViewModel;
    }

    protected function resolveDbModel(){
        $viewModel = $this->viewModel;
        $modelClass = $this->modelName;
        $dbModel = $viewModel && property_exists($viewModel, 'id') && $viewModel->id ? $modelClass::find($viewModel->id) : new $modelClass;
        foreach ($this->fields as $field) {
            $field->viewToDb($viewModel, $dbModel);
        }
        //\Log::notice(json_encode($viewModel));
        return $dbModel;
    }

    protected function resolveViewModel(){
    	$id = $this->id;
    	$modelClass = $this->modelName;
        $dbModel = $id ? $modelClass::findOrFail($id) : new $modelClass;
        $viewModel = new \stdClass;
        //\Log::notice($this->modelClass);
        $viewModel->id = $id ? $id :'';
        foreach ($this->fields as $field) {
            $field->dbToView($dbModel, $viewModel);
        }
        foreach ($this->readOnlyFields as $field) {
            $fieldName = $field->field;
            $field->defaultValue($viewModel->$fieldName);
        }
        //\Log::notice(json_encode($dbModel));
        //\Log::notice(json_encode($viewModel));
        return $viewModel; 
    }

    function validate(){
        $errors = [];
        foreach ($this->fields as $field) {
            $fieldErrors = $field->validate();

            $errors = array_merge_recursive($errors, $fieldErrors);
        }

        if(count($errors) > 0){
            throw new ValidateException($errors);
        }
    }


    function preSave($viewModel, $dbModel){
        foreach ($this->fields as $field) {
            $field->preSave($viewModel, $dbModel);
        }
    }

    function saveRelations($viewModel){
        $dbModel = $this->getDbModel();
        foreach ($this->fields as $field) {
            $field->saveRelation($viewModel, $dbModel);
        }
    }


}