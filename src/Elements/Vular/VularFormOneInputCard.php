<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\MakeAble;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
//use Water\Vular\Elements\Vuetify\VFlex;

class VularFormOneInputCard extends VCard{
    protected $fieldInput;
    public function __construct(){
        parent::__construct();
        //$this->flat();
    }

    function input($fieldInput){
        $this->fieldInput = $fieldInput;
        $this->children($fieldInput);
        return $this;

    }

    function fields(){
        return [$this->fieldInput];
    }
}

