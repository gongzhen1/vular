<?php
namespace Water\Vular\PreMades\Trades\Sample;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        //$this->node(function($node){
        //    $node->becomeToSubheader('外贸');
        //});

        $this->node(function($node){
            $node->becomeToTile('样品管理')
                ->icon('redeem')
                ->to(SampleList::make());
        });

	}

}