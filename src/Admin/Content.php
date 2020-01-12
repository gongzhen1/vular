<?php
namespace Water\Vular\Admin;

use Water\Vular\VularAble;

use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContent;
use Water\Vular\Elements\Vular\VularPageLoadingProgressLinear;

class Content implements VularAble{

    public function __construct(){

    }

    static public function make(){
        return new Content();
    }


    function toVular()
    {
        return 
                VularNode::make()->becomeTo('transition')
                    ->children(
                        VularNode::make()->becomeTo('router-view')
                    )
        ;   
    }
}