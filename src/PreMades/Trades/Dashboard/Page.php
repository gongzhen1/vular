<?php
namespace Water\Vular\PreMades\Trades\Dashboard;

use Water\Vular\Admin\Page as VularAdminPage;
use Water\Vular\Admin\Breadcrumbs;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VSubheader;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAvatar;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VListTileTitle;
use Water\Vular\Elements\Vuetify\VListTileSubTitle;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Models\Admin;
use DB;

class Page extends VularAdminPage{
    protected $title = '主控板';


    function register(){
        parent::register();
        $this->breadcrumbs->textItem('主控板');
    }

    function makeUI(){
        $this->children(
                $this->breadcrumbs,
                VLayout::make()
                ->row()
                ->wrap()
                ->children(
                    $this->cards(),
                    $this->card(null,'xs12','assessment')->hiddenBy('order_all_data')
                )
            );
    }

    function cards(){
        $cards = [];
        foreach (Admin::all() as $user) {
            if(!$user->issupper){
                array_push($cards , $this->card($user)->hidden(!user()->isPermitted('order_all_data') && user()->id != $user->id));
            }
        }
        //array_push($cards , $this->card('汇总','xs12','assessment'));
        return $cards;
    }

    function card($user, $width = 'xs6', $icon="face"){
        $userId = $user ? $user->id : 0;
        $title = $user ? $user->name : '汇总';
        $row = $this->queryOrdersAndCollectionsInfo($userId);
        $paysRow = $this->queryPayInfo($userId);
        return VFlex::make()
                        ->class($width .' pa-3')
                        ->children(
                            VCard::make()
                                ->children(
                                    VToolbar::make()
                                        ->light()
                                        //->color('transparent')
                                        ->flat()
                                        ->card()
                                        ->children(
                                            VIcon::make($icon),
                                            VToolbarTitle::make($title)
                                        ),
                                    VDivider::make()
                                )
                                ->children(
                                    VCardText::make()
                                    ->class('pa-4')
                                    ->children(
                                        VList::make()
                                            ->twoLine()
                                            ->subheader()
                                            ->children(
                                                VSubheader::make('订单'),
                                                $this->listTile('未结订单数：'.($row->order_counts - $row->passed_order_counts), 'label_important'),
                                                $this->listTile('已结订单数：' .$row->passed_order_counts, 'label_off'),
                                                $this->listTile('订单总数：'.$row->order_counts),
                                                VSubheader::make('账款'),
                                                $this->listTile('未收账款：$' .($row->dollar_contract_amount - $row->dollar_already_collection) 
                                                    .', €' .($row->euro_contract_amount - $row->euro_already_collection)
                                                    .', ￥'.($row->rmb_contract_amount - $row->rmb_already_collection), 'monetization_on'),
                                                $this->listTile('已收账款：$'.$row->dollar_already_collection . ', €' .$row->euro_already_collection .', ￥' .$row->rmb_already_collection, 'money_off'),
                                                $this->listTile('总账款：$' .$row->dollar_contract_amount . ', €' .$row->euro_contract_amount . ', ￥'.$row->rmb_contract_amount, 'attach_money'),
                                                VSubheader::make('货款'),
                                                $this->listTile('未付货款：$' .($paysRow->dollar_contract_amount - $paysRow->dollar_already_pay) 
                                                    .', €' .($paysRow->euro_contract_amount - $paysRow->euro_already_pay)
                                                    .', ￥'.($paysRow->rmb_contract_amount - $paysRow->rmb_already_pay), 'monetization_on'),
                                                $this->listTile('已付货款：$'.$paysRow->dollar_already_pay . ', €' .$paysRow->euro_already_pay .', ￥' .$paysRow->rmb_already_pay, 'money_off'),
                                                $this->listTile('总货款：$' .$paysRow->dollar_contract_amount . ', €' .$paysRow->euro_contract_amount . ', ￥'.$paysRow->rmb_contract_amount, 'attach_money')
                                            )
                                    )
                                )
                        );
    }

    function listTile($title, $icon = 'label' ){
        return VListTile::make()
            ->avatar()
            ->children(
                VListTileAvatar::make()
                    ->children(VIcon::make($icon)),
                VListTileContent::make()
                    ->children(
                        VListTileTitle::make($title)
                    )
            );
    }

    function queryOrdersAndCollectionsInfo($userId){
        $expressions = [];
        if($userId > 0){
            $expressions[0] = ['orders.user_id', '=', $userId];
        }
        return \DB::table('orders')
                    ->selectRaw("
                        sum(
                            if(orders.currency='Dollar',
                                ifnull(orders.contract_amount,0),
                            0)
                        ) as dollar_contract_amount,
                        sum(
                            if(orders.currency='Euro',
                                ifnull(orders.contract_amount,0),
                            0)
                        ) as euro_contract_amount,
                        sum(
                            if(orders.currency='RMB',
                                ifnull(orders.contract_amount,0),
                            0)
                        ) as rmb_contract_amount,
                        sum(
                            if(orders.currency='Dollar',
                                ifnull(orders.first_collection_amount,0) + ifnull(orders.second_collection_amount,0),
                            0)
                        ) as dollar_already_collection,
                        sum(
                            if(orders.currency='Euro',
                                ifnull(orders.first_collection_amount,0) + ifnull(orders.second_collection_amount,0),
                            0)
                        ) as euro_already_collection,
                        sum(
                            if(orders.currency='RMB',
                                ifnull(orders.first_collection_amount,0) + ifnull(orders.second_collection_amount,0),
                            0)
                        ) as rmb_already_collection,
                        count(orders.id) as order_counts,
                        count(IF (orders.passed = 1, TRUE, NULL)) as passed_order_counts
                    ")
                    ->where($expressions)
                    ->first();
    }

    function queryPayInfo($userId){
        $expressions = [];
        if($userId > 0){
            $expressions[0] = ['orders.user_id', '=', $userId];
        }
        return \DB::table('factory_orders')
                    ->leftJoin('orders', 'factory_orders.order_id', '=', 'orders.id')
                    ->selectRaw("
                        sum(
                            if(factory_orders.currency='Dollar',
                                ifnull(factory_orders.contract_amount,0),
                            0)
                        ) as dollar_contract_amount,
                        sum(
                            if(factory_orders.currency='Euro',
                                ifnull(factory_orders.contract_amount,0),
                            0)
                        ) as euro_contract_amount,
                        sum(
                            if(factory_orders.currency='RMB',
                                ifnull(factory_orders.contract_amount,0),
                            0)
                        ) as rmb_contract_amount,
                        sum(
                            if(factory_orders.currency='Dollar',
                                ifnull(factory_orders.first_pay_amount,0) + ifnull(factory_orders.second_pay_amount,0),
                            0)
                        ) as dollar_already_pay,
                        sum(
                            if(factory_orders.currency='Euro',
                                ifnull(factory_orders.first_pay_amount,0) + ifnull(factory_orders.second_pay_amount,0),
                            0)
                        ) as euro_already_pay,
                        sum(
                            if(factory_orders.currency='RMB',
                                ifnull(factory_orders.first_pay_amount,0) + ifnull(factory_orders.second_pay_amount,0),
                            0)
                        ) as rmb_already_pay
                    ")
                    ->where($expressions)
                    ->first();
    }
}