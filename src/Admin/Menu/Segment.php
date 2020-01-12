<?php
namespace Water\Vular\Admin\Menu;

use Water\Vular\VularAble;

abstract class Segment implements VularAble{

    private $nodes = [];

    public function __construct(){
    }

    abstract function build();

    function node(\Closure $callback){
        $node = new Node;
        $callback($node);
        array_push($this->nodes, $node);
        return $this;
    }

    function toVular()
    {
        $this->build();
        $vularNodes = [];
        foreach ($this->nodes as $node) {
            array_push($vularNodes, $node->toVular());
        }
        return $vularNodes;
    }

}