<?php
namespace Water\Vular\Admin\Permission;


class Node {
    public $children = [];

    public function __construct(){
        $this->slug = uniqid('vular-per-group-');
    }

    function name($name){
        $this->name = $name;
        return $this;
    }

    function slug($slug){
        $this->slug = $slug;
        return $this;
    }

    function authPoint($slug, $name){
        $child = new Node;
        $child->name = $name;
        $child->slug = $slug;
        array_push($this->children, $child);
        return $this;
    }

    function authPoints($pointsArray){
        foreach ($pointsArray as $key => $value) {
            $this->authPoint($key, $value);
        }
        return $this;
    }

    function child(\Closure $callback){
        $child = new Node;
        $callback($child);
        array_push($this->children, $child);
        return $this;
    }

}