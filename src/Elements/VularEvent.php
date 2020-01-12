<?php
namespace Water\Vular\Elements;


//由界面JS决定VularEvent的处理方式
class VularEvent{
    public $isEvent = true;
    public function __construct($action = null, $params = []){
        $this->action($action, $params);
    }

    static public function make($action = null, $params = []){
        $className = get_called_class();
        $node = new $className($action, $params);
        return $node;
    }

    function action($value, $params = []){
        $functionName = __FUNCTION__;
        $this->$functionName = $value;
        $this->params = $params;
        return $this;
    }

    function valid(bool $value = true){
        $this->params['valid']  = $value;
        return $this;
    }

    function bindsTo($panel){
        $this->params['vularId'] = $panel->vularId();
        return $this;
    }

}