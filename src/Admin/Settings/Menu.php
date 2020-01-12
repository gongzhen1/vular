<?php
namespace Water\Vular\Admin\Settings;

use Water\Vular\Admin\Menu\Segment as MenuSegment;
use Water\Vular\Admin\Pages\SettingsPage;
use Water\Vular\Admin\CRUDs\Admin\AdminList;
use Water\Vular\Admin\CRUDs\Role\RoleList;

class Menu extends MenuSegment{

    function build(){
        $this->node(function($node){
            $node->becomeToTile('系统设置')
                ->icon('settings')
                ->to(Page::make())
                ->disabledBy('xxx');
        });

     }

}

/*	function build(){
		$this->order = '1000';

		$this->menuNode(function($menuNode){
			$menuNode->becomeToSubheader('系统设置');
		});

		$this->menuNode(function($menuNode){
			$menuNode->becomeToDivider();
		});

		$this->menuNode(function($menuNode){
			$menuNode->becomeToTile('第二个 Menu')
                ->icon('edit')
                ->to('xxxx');
		});

        $this->menuNode(function($menuNode){
            $menuNode->becomeToTile('第三个 Menu')
                ->icon('settings')
                ->to('xxxx2')
                ->chip('Hot', function($chip){
                   $chip->color('red');
                   $chip->textColor('white');
                   $chip->style('font-size','10px');
                   $chip->style('height','12px');

                });
        });

        $this->menuNode(function($menuNode){
            $menuNode->becomeToTile('Table')
                ->icon('rowing')
                ->to(['name'=>'adminpage','params'=>['pageid'=>'table']])
                ->badge('3', function($badge){
                   $badge->color('green');
                });
        });

        $this->menuNode(function($menuNode){
            $menuNode->becomeToTile('第四个 Menu')
                ->icon('stars')
                ->to('xxxxx3')
                ->badge('5', function($badge){
                   $badge->color('yellow');
                })
                ->chip('New', function($chip){
                   $chip->color('blue');
                   $chip->textColor('white');
                   //$chip->style('font-size','14px');
                   //$chip->style('height','12px');

                });
        });
*/