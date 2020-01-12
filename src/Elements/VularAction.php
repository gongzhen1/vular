<?php
namespace Water\Vular\Elements;

use Water\Vular\Elements\MakeAble;

//回传到PHP端处理
class VularAction{
    public function __construct(){
        $this->params = new \stdClass;
        $this->method = 'post';
    }
    static public function make($action = null){
        $className = get_called_class();
        $node = new $className;
        $node->action = $action;
        return $node;
    }

    function owner($vularId){
        $this->owner = $vularId;
        return $this;
    }

    function isBound(){
        return property_exists($this, 'owner') && $this->owner;
    }

    function action($action){
        $this->action = $action;
        return $this;
    }

    function keyCode($keyCode){
        $this->keyCode = $keyCode;
        return $this;
    }

    function param($key, $value){
        $this->params->$key = $value;
        return $this;
    }

    function get(){
        return $this->method('get');
    }

    function post(){
        return $this->method('post');
    }

    function delete(){
        return $this->method('delete');
    }

    private function method($method){
        $this->method = $method;
        return $this;
    }

    function valid(bool $value = true){
        $this->valid = $value;
        return $this;
    }

    function confirm($message){
        $this->confirm = $message;
        return $this;
    }

    function bindsTo($panel){
        $this->owner = $panel->vularId();
        return $this;
    }

}