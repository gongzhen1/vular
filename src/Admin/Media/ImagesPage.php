<?php
namespace Water\Vular\Webadmin\Media;

use Water\Vular\Admin\Page;
//use Water\Vular\Admin\Breadcrumbs;
use Water\Vular\Elements\VularNode;
use Water\Vular\Models\MediaCategory;
use Water\Vular\Elements\Vular\VularMedias;

class ImagesPage extends Page{

    function register(){
        parent::register();
        $this->becomeTo('div');
    	//$this->title = "图片管理";
        //$this->breadcrumbs->textItem('媒体库')
        //            ->textItem('图片管理');
    }

    function makeUI(){
        $this->class('pa-0 ma-0')
            ->children(
            VularMedias::make()
                //->modelClass(MediaCategory::class)
                ->typeName('图片')
        );
    }
}