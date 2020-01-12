<?php
namespace Water\Vular\Elements\Vuetify;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Fieldable;
use Water\Vular\Elements\Validate;

class VCombobox  extends VInput{
    //use Validate, Fieldable;
    protected $widthEdit;
    public function __construct(){
        parent::__construct();
        $this->name = getbase(__CLASS__);
        $this->itemValue('id');
        $this->itemText('name');
    }

    function widthEdit(bool $value = true){
        $this->widthEdit = $value;
        return $this;
    }

    function isWithEdit(){
        return $this->widthEdit;
    }

	function allowOverflow(bool $value = true){
		return $this->props(__FUNCTION__, $value);
	}
	
    function appendIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendOuterIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function appendOuterIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function attach(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function autoSelectFirst(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function autofocus(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    function backgroundColor($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function box(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function browserAutocomplete($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function cacheItems(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function chips(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function clearIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function clearIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    function clearable(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function color($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function counter($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dark(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function deletableChips(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dense(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function disabled(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function dontFillMaskBlanks(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function error(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function errorCount($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function errorMessages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function filter($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function flat(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function fullWidth(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function height($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hideDetails(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hideNoData(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function hideSelected(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function hint($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemAvatar($value){
        return $this->props(__FUNCTION__, $value);
    }
     function itemDisabled($value){
        return $this->props(__FUNCTION__, $value);
    }
    
     function itemText($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function itemValue($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function items($value){
        return $this->props(__FUNCTION__, $value);
    }

    function label($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function light(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function loading(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function mask($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function menuProps($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function messages($value){
        return $this->props(__FUNCTION__, $value);
    }

    function multiple(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function noDataText($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function noFilter(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function openOnClear(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function outline(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function persistentHint(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function placeholder($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prefix($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependIcon($value){
        return $this->props(__FUNCTION__, $value);
    }

    function prependIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependInnerIcon($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function prependInnerIconCb($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function readonly(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }

    function returnMaskedValue(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function returnObject(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function reverse(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function searchInput($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function singleLine(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function smallChips(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function solo(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function soloInverted(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function success(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function successMessages($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function suffix($value){
        return $this->props(__FUNCTION__, $value);
    }

    function type($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function validateOnBlur(bool $value = true){
        return $this->props(__FUNCTION__, $value);
    }
    
    function value($value){
        return $this->props(__FUNCTION__, $value);
    }
    
    function valueComparator($value){
        return $this->props(__FUNCTION__, $value);
    }

    function convertToDb($value, $modelName = null){
        if($value && is_array($value)){
            $objects = [];
            $itemValue = $this->props->itemValue;
            $itemText = $this->props->itemText;
            foreach ($value as $item) {
                $dbObj = property_exists($item, $itemValue) && $item->$itemValue ? $modelName::find($item->$itemValue) : new $modelName;

                $dbObj->$itemText = property_exists($item, $itemText) ? $item->$itemText : $item;

                array_push($objects, $dbObj);
            }
            return parent::convertToDb($objects);
        }
        else{
            return parent::convertToDb($value);
        }

    }
}