<?php
namespace Water\Vular\Core;

use Water\Vular\Admin\Page;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\VularAction;

trait Form {

    protected $modelClass;
    protected $form;
    private $formModel;

    function bindsFormData($id){
        $this->bindFields();
        $this->bindActions();

        $formModel = $this->resolveFormModel($id);
        $viewModel = $formModel->getViewModel();
        $this->form->viewModel($viewModel );
    }


    function resolveFields($vularNode = null, $fields = null){
        $vularNode = $vularNode ? $vularNode : $this->form;
        $fields = $fields ? $fields : collect([]);
        if(property_exists($vularNode, 'field')){
            $fields->push($vularNode);
        }
        else if(property_exists($vularNode, 'children')) {
            foreach ($vularNode->children as $node) {
                $this->resolveFields($node, $fields);
            }
        }
        return $vularNode ? $fields : $vularNode->toArray();
    }

    function resolveFormModel($id){
        $this->formModel = $this->formModel ? $this->formModel : new FormModel($this->resolveFields(), $this->modelClass, $id);
        return $this->formModel;
    }


    function modelClass(){
        return $this->modelClass;
    }

    function doSave($viewModel, \Closure $callBack = null){
        //\Log::notice(json_encode($viewModel));
        $formModel = $this->resolveFormModel($viewModel->id);
        $formModel->viewModel($viewModel);
        $formModel->validate();
        $dbModel = $formModel->getDbModel();

        $this->beforeSave($dbModel);
        //$this->preSave($viewModel, $dbModel)
        if($callBack){
            $callBack($dbModel);
        }
        $formModel->save();
        //$this->saveRelations($viewModel, $dbModel);
        return VularResponse::make($viewModel);
    }


    function beforeSave($dbModel){
    }

    function duplicateViewModel($viewModel){
        return $this->formModel->duplicate($viewModel);
    }

    protected function bindFields(){
        foreach ($this->resolveFields() as $field) {
            $field->bindsTo($this->form);
        }
    }

    protected function bindActions($vularNode = null){
        $vularNode = $vularNode ? $vularNode : $this->form;
        if(property_exists($vularNode, 'on')){
            foreach ($vularNode->on as $action) {
                if(is_a($action, VularAction::class)){
                    $action->bindsTo($this->form);
                }
            }
        }
        if(property_exists($vularNode, 'children')) {
            foreach ($vularNode->children as $node) {
                $this->bindActions($node);
            }
        }
    }

}