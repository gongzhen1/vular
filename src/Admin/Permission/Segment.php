<?php
namespace Water\Vular\Admin\Permission;

abstract class Segment{

    private $nodes = [];

    public function __construct(){
        $this->build();
    }

    abstract function build();

    function node(\Closure $callback){
        $node = new Node;
        $callback($node);
        array_push($this->nodes, $node);
        return $this;
    }

    function toNodes(){
        return $this->nodes;
    }

}