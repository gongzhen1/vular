<?php
namespace Water\Vular\Admin\Dashboard;

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
                                            VToolbarTitle::make('test')
                                        ),
                                    VDivider::make()
                                )
                                ->children(
                                    VCardText::make()
                                    ->class('pa-4')
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


}