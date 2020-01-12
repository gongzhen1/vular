<?php
namespace Water\Vular\Elements;

class NodeData{
    public function add($key, $value){
        $this->$key = $value;
    }

}