<?php

namespace Water\Vular\Models;

trait VularTree{
	protected $order = 'order';
	protected $itemKey = 'id';
	protected $parentKey = "parent_id";
    protected $childrenIds = [];


    function setOrder($order){
        $this->order = $order;
    }
    function setItemKey($itemKey){
        $this->itemKey = $itemKey;
    }
    function setParentKey($parentKey){
        $this->parentKey = $parentKey;
    }

    function buildTree(){
        $tree = $this->whereNull($this->parentKey)
            ->orderBy($this->order,'asc')->get();
        foreach ($tree as $node) {
            //$this->buildNestedNodes($node);
            $node->bulidChildren();
        }
        //\Log::notice(json_encode($tree));
        return $tree;
    }

    function bulidChildren(){
        $this->buildNestedNodes($this);
        return $this->children;
    }

    function childrenIds(){
        return $this->childrenIds;
    }

    protected function buildNestedNodes($parent){
        $itemKey = $this->itemKey;
        $parent->children = $this->where($this->parentKey, $parent->$itemKey)
            ->orderBy($this->order,'asc')->get();

        foreach ($parent->children as $node) {
            array_push($this->childrenIds, $node->$itemKey);
            $this->buildNestedNodes($node);
        }
    }

}
