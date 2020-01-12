<?php
namespace Water\Vular\Core;

use Water\Vular\Elements\MakeAble;
use Water\Vular\Elements\VularEvent;
class VularResponse{
    public $beforeEvents = [];

    public $afterEvents = [];

    static public function make($viewModel = null){
        $self = new VularResponse;
        $self->viewModel($viewModel);
        return $self;
    }

    function addBeforeEvent($event){
        array_push($this->beforeEvents, $event);
        return $this;
    }

    function addAffterEvent($event){
        array_push($this->afterEvents, $event);
        return $this;
    }


    function makeAfterEvent($action, $params = null){
        $event = VularEvent::make($action, $params);
        array_push($this->afterEvents, $event);
        return $this;
    }

    function viewModel($viewModel){
        $this->viewModel = $viewModel;
        return $this;
    }

    function errors($errors){
        $this->errors = $errors;
        return $this;
    }

    function success(){
        $this->makeBeforeEvent('success', trans('vular.operate-success'));
        return $this;
    }

    function closePage(){
        $this->makeBeforeEvent('closePage');
        return $this;
    }

    //function closeAndRefresh(){
    //    $this->makeBeforeEvent('closeAndRefresh');
    //    return $this;
    //}
            
    function refresh(){
        $this->makeBeforeEvent('refresh');
        return $this;
    }

    function makeBeforeEvent($action, $params = null){
        $event = VularEvent::make($action, $params);
        array_push($this->beforeEvents, $event);
        return $this;
    }

}