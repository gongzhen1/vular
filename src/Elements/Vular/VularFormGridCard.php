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

class VularFormGridCard extends VCard{
    protected $formGrid;

    protected $toolBarTitle;

    protected $cardText;

    public function __construct(){
        parent::__construct();
        $this->formGrid = VularFormGrid::make();
        $this->toolBarTitle = VToolbarTitle::make();
        $this->cardText = VCardText::make();
        $this->children(
            VToolbar::make()
                //->dark()
                //->color('transparent')
                ->flat()
                ->card()
                ->children(
                  $this->toolBarTitle  
                ),
            VDivider::make(),
            $this->cardText
            ->children(
                $this->formGrid
            )
            
        );
    }

    function cardTextClass($class){
        $this->cardText->class($class);
        return $this;
    }   

    function title($title){
        $this->toolBarTitle->text($title);
        return $this;

    }

    function flex($field, $classes = 'xs12'){
        $this->formGrid->flex($field, $classes)
            ->class('pa-2');
        return $this;

    }

    function fields(){
        return $this->formGrid->fields();
    }
}

