<?php
namespace Water\Vular\Elements\Relations;

use Water\Vular\Elements\MakeAble;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
//use Water\Vular\Elements\Vuetify\VFlex;

class VularFormHasManyCard extends VCard{

    protected $editor;

    public function __construct($type){
        parent::__construct();
        if($type == 'pannel'){
            $this->editor = VularHasManyPanel::make();
        }
        if($type == 'table'){
            $this->editor = VularHasManyTable::make();
        }
        $this->children(
            $this->editor
            
        );
    }

    static public function make($type = 'pannel'){
        return new VularFormHasManyCard($type);
    }

    function title($title){
        $this->editor->title($title);
        return $this;

    }

    function editDialogWidth($value){
        $this->editor->editDialogWidth($value);
        //return $this->props(__FUNCTION__, $value);
    }

    function flex($field, $classes = 'xs12'){
        $this->editor->flex($field, $classes);
        return $this;

    }

    function field($value){
        //$this->field = $value;//阻止递归获取form input 控件
        $this->editor->field($value);
        return $this;
    }

    function fields(){
        return [$this->editor];
    }
}

