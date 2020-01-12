<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{
    function build(){
        //$this->node(function($node){
        //    $node->becomeToSubheader('外贸');
        //});

        $this->node(function($node){
            $node->becomeToTile('客户管理')
                ->icon('account_box')
                ->to(CustomerList::make())
                ->hiddenBy('customer_module');
        });

        $this->node(function($node){
            $node->becomeToTile('供应商管理')
                ->icon('portrait')
                ->to(SupplierList::make())
                ->hiddenBy('supplier_module');
        });


    }


}