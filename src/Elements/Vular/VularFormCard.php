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

class VularFormCard extends VCard{
    protected $toolBarTitle;
    protected $content;
    protected $cardText;
    public function __construct(){
        parent::__construct();
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
        );
    }

    function title($title){
        $this->toolBarTitle->text($title);
        return $this;

    }

    function content($content){
        $this->cardText->children($content);
        return $this;
    }

    function fields(){
        return [];
    }
}

