<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Menu\Segment as MenuSegment;
use Water\Vular\Admin\Pages\SettingsPage;

class Menu extends MenuSegment{

    function build(){

        $this->node(function($node){
            $node->becomeToSubheader(trans('vular.system-mgr'))
                ->hiddenBy('admin_setting');
        });

        $this->node(function($node){
            $node->becomeToGroup(trans('vular.users-mgr'))
                ->icon('supervised_user_circle')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.administrators'))
                        //->icon('settings')
                        ->to(AdminList::make())
                        ->hiddenBy('users_module');
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.roles'))
                        //->icon('settings')
                        ->to(RoleList::make())
                        ->hiddenBy('roles_module');
                })
                ->hiddenBy('admin_setting')
                //->child(function($child){
                //    $child->becomeToTile('组')
                        //->icon('settings')
                //        ->to('xxyxx55');
                //})
                ;
        });


     }

}