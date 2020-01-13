<?php
namespace Water\Vular\Admin;

use Water\Vular\Elements\Html\Span;
use Water\Vular\Elements\Vuetify\VApp;
use Water\Vular\Elements\Vuetify\VFooter;
use Water\Vular\Elements\VularNode;

class Vular{
    public function __construct(){
    }

    function rootNode(){
        return VApp::make()
            ->class('app')
            ->style('background-color', '#f0f4f7')
            ->id('layout')
            ->light()
            ->children(
                LeftNavigationDrawer::make($this->menus())->toVular(),
                Toolbar::make()->toVular(),
                Content::make()->toVular(),
                VFooter::make()
                    ->class("app--footer")
                    ->inset()
                    ->app()
                    ->absolute()
                    ->children(
                        Span::make('©2019  — Vular')
                        ->class("px-3")
                    ),
                VularNode::make()->becomeTo('VularTopMessage'),
                VularNode::make()->becomeTo('vular-appfab')
                    ->props('medium', true)
                    ->props('dark', true)
                    ->props('color', 'red')
            )
            ->removeHidden();
    }

    function menus(){
        $vularNods = [];
        $menuClasses = config('vular.menus');
        foreach ($menuClasses as $menuClass) {
           $vularNods = array_merge_recursive($vularNods, (new $menuClass)->toVular());
        }
        return $vularNods;
    }
}