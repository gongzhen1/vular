<?php
namespace Water\Vular\Admin;

use Water\Vular\Elements\Vular\VularPage;

abstract class Page extends VularPage{
    protected $breadcrumbs;
    protected $title;

    public function __construct(){
        parent::__construct('adminpage');
        //$this->initialize();
    }

    function register(){
        $this->breadcrumbs = Breadcrumbs::make();
    }

    abstract function makeUI();

    function bindsData(){
    }


    //abstract function initialize();

    function breadcrumb($text){
        $this->breadcrumbs->textItem($text);
        $this->title = $text;
    }

    function build(){
        $this->register();
        $this->makeUI();
        $this->bindsData();
        $this->removeHidden();

        return $this;
    }

}