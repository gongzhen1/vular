<?php
namespace Water\Vular\PreMades\Trades\Order;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        //$this->node(function($node){
        //    $node->becomeToSubheader('外贸');
        //});
        $this->node(function($node){
            $node->becomeToSubheader('外贸管理');
        });

        $this->node(function($node){

            $node->becomeToTile('订单管理')
                ->icon('monetization_on')
                ->to(OrderList::make());

            /*$node->becomeToGroup('外贸管理')
                ->icon('monetization_on')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.orders'))
                        ->to(OrderList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.customers'))
                        ->to(CustomerList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.suppliers'))
                        ->to(SupplierList::make());
                })
                ;*/
        });

	}

}