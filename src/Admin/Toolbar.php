<?php
namespace Water\Vular\Admin;

use Water\Vular\VularAble;
use Water\Vular\Elements\Html\Span;
use Water\Vular\Elements\Html\Img;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularEvent;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarSideIcon;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VBadge;
use Water\Vular\Elements\Vuetify\VMenu;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VAvatar;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VlistTileTitle;
use Water\Vular\Elements\Vular\VularAsyncPanel;
use Water\Vular\Admin\User\AdminEdit;

class Toolbar implements VularAble{

    public function __construct(){

    }

    static public function make(){
        return new Toolbar();
    }


    function toVular()
    {
        return VToolbar::make()
            ->app()
            ->light()
            ->children(
                VToolbarSideIcon::make()
                    ->on('click',['action'=>'hideOrShowDrawer']),
                VSpacer::make(),
                VularNode::make()->becomeTo('VularFullscreenButton'),
                //VBtn::make()
                //    ->icon()
                //    ->href("#")
                //    ->children(
                //        VIcon::make('help_outline')
                //             ->medium()
                //    ),
                //$this->creadEventsPopMenu(),
                $this->createProfilePopMenu()
            );
    }


    protected function createProfilePopMenu(){
        return VMenu::make()
            ->offsetY()
            ->origin('center center')
            ->nudgeBottom('10')
            ->transition('scale-transition')
            ->children(
                VBtn::make()
                    ->icon()
                    ->slot("activator")
                    ->large()
                    ->flat()
                    ->children(
                        VAvatar::make()
                            ->size('30px')
                            ->children(
                                VIcon::make('account_circle')
                                //Img::make()
                                //   ->src('/vular/images/touxiang.jpg')
                                //   ->alt('Martin Li Avatar')
                            )
                    ),
                VList::make()
                     ->class('pa-0')
                     ->children(
                        VListTile::make()
                            ->ripple(true)
                            ->rel('noopener')
                            ->children(
                                VListTileAction::make()
                                    ->children(
                                        VIcon::make('assignment_ind')
                                    ),
                                VListTileContent::make()
                                    ->children(
                                        VlistTileTitle::make('个人信息')
                                    )
                            )
                            ->click(
                                AdminEdit::make()
                                    ->toMeAction()
                                    ->param('id', user()->id)
                            ),
                        VListTile::make()
                            ->ripple(true)
                            ->rel('noopener')
                            ->children(
                                VListTileAction::make()
                                    ->children(
                                        VIcon::make('power_settings_new')
                                    ),
                                VListTileContent::make()
                                    ->children(
                                        VlistTileTitle::make('退出')
                                    )
                            )
                            ->click(
                                VularEvent::make()
                                    ->action('logout')
                            )
                     )
            );        
    }

    protected function creadEventsPopMenu(){
        //$lastedEvents = LastedEventsPannel::make();
        //$lastedEvents->getAction('load')->do();

        return VMenu::make()
            ->offsetY()
            ->origin('center center')
            ->nudgeBottom('10')
            ->transition('scale-transition')
            ->children(
                VBtn::make()
                    ->icon()
                    ->slot("activator")
                    //->click($lastedEvents->getAction('load'))
                    ->children(
                        VBadge::make()
                            ->color('red')
                            ->overlap()
                            ->children(
                                Span::make('6')
                                ->slot('badge'),
                                VIcon::make('notifications')
                                     ->medium()
                            )
                    ),
                VCard::make()
                    ->class('elevation-0')
                    ->children(
                        VToolbar::make()
                            ->card()
                            ->dense()
                            ->color('transparent')
                                ->children(
                                    VToolbarTitle::make('Notification')
                                ),
                        VDivider::make()
                        //$lastedEvents
                    )
            );        

    }
}