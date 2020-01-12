<?php
namespace Water\Vular\Admin;

use Water\Vular\Admin\Page;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VBreadcrumbs;

class Breadcrumbs extends VLayout{
    protected $breadcrumbs;

    public function __construct(){
        parent::__construct();
        $this->breadcrumbs = VBreadcrumbs::make()
            ->divider('-');
        //$this->item(function($item){
        //    $item->text = 'Dashboard';
        //});
        $this->class('align-center grid-list-md row')
            ->children(
                VIcon::make('home')
                    ->small(),
                $this->breadcrumbs
            );
        $this->breadcrumbs->items([]);
    }

    function item(\Closure $callback){
        $item = new \stdClass;
        $callback($item);
        array_push($this->breadcrumbs->props->items, $item);

        return $this;
    }

    function textItem($text){
        $item = new \stdClass;
        $item->text = $text;
        $item->disabled = true;
        array_push($this->breadcrumbs->props->items, $item);
        return $this;
   }


}