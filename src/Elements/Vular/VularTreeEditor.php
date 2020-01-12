<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;
use Water\Vular\Elements\Vuetify\VToolBar;
use Water\Vular\Elements\Vuetify\VToolBarTitle;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VBtn;

final class VularTreeEditor extends VularNode{
    use Validate, Fieldable;
    public function __construct(){
        parent::__construct();
        $this->itemKey('id');
        $this->itemText('name');
        $this->itemOrder('order');
        $this->parentKey('parent_id');
        $this->props('flexs', []);

        $this->activatable();
        $this->hoverable();
        $this->multipleActive(false);
        $this->activeClass('tree-node-active');
        $this->openOnClick();
        $this->leafIcon(VIcon::make('folder'));
        $this->openIcon(VIcon::make('folder_open'));
        $this->closeIcon(VIcon::make('folder'));
    }   

    function activatable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function activeClass($value){
        return $this->props(__FUNCTION__, $value);
    }

    function addBtn($value){
        return $this->props(__FUNCTION__, $value);
    }

    function saveBtn($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function expandIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hoverable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function indeterminateIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemChildren($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemKey($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getItemKey(){
        return $this->props->itemKey;
    }
    
    function itemText($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getItemText(){
        return $this->props->itemText;
    }


    function itemOrder($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getItemOrder(){
        return $this->props->itemOrder;
    }

    function parentKey($value){
        return $this->props(__FUNCTION__, $value);
    }

    function getParentKey(){
        return $this->props->parentKey;
    }

    
    function items($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function multipleActive(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function openAll(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function openOnClick(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function selectable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function selectedColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function transition(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function flat(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    function tile(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function label($value){
        return $this->props(__FUNCTION__, $value);
    }

    function nodeLabelColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    function leafIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    function openIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    function closeIcon($value){
        return $this->props(__FUNCTION__, $value);
    }


    function flex($field, $classes = 'xs12'){
        $flex = new \stdClass;
        $flex->class = $classes . ' pa-2';
        $flex->field = $field;
        array_push($this->props->flexs, $flex);
        return $this;

    }

    function flexs(){
        return $this->props->flexs;
    }

    function blankValue(){
        return [];
    }

}