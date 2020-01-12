<?php
namespace Water\Vular\Admin;

use Water\Vular\VularAble;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vular\VularDrawer;
use Water\Vular\Elements\Vular\VularDrawerToolbar;


class LeftNavigationDrawer implements VularAble{
    public static $menus = [];

    private $vularDrawer;
    private $header;
    private $list;

    public function __construct($menus){
        $this->vularDrawer = VularDrawer::make()             
            ->class('app--drawer')
            ->style('overflow', 'hidden')
            //->clipped()
            ->floating()
            ->miniVariant(false)
            ->app()
            ->dark();
        $this->header = VularDrawerToolbar::make()
            ->title('Vular')
            ->logo('/vular/images/logo.png')
            ->showMiniButton()
            ->dark()
            ->href('#')
            ->drawerMini(false);
        $this->list = VList::make()
            ->dense()
            ->expand()
            ->dark()
            ->children($menus);

    }

    static public function make($menu){
        return new LeftNavigationDrawer($menu);
    }


    function header($header){
        $this->header = $header;
        return $this;
    }

    function subheader($title){
        $this->list->children(
            VSubheader::make($title)
        );
    }

    function toVular()
    {
        return $this->vularDrawer->children(
            $this->header,
            VularNode::make()->becomeTo('div')
            ->style('overflow','auto')
            ->style('height','calc(100vh - 48px)')
            ->children($this->list)
        );
    }
}