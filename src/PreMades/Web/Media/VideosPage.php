<?php
namespace Water\Vular\PreMades\Web\Media;

use Water\Vular\Admin\Page;
//use Water\Vular\Admin\Breadcrumbs;
use Water\Vular\Elements\VularNode;
use Water\Vular\Models\MediaCategory;
use Water\Vular\Elements\Vular\VularMedias;

class VideosPage extends Page{

    function register(){
        parent::register();
        $this->becomeTo('div');
    	//$this->title = trans("视频管理");
        //$this->breadcrumbs->textItem('媒体库')
                    //->textItem('视频管理');
    }

    function makeUI(){
        $this->class('pa-0 ma-0')
            ->children(
            VularMedias::make()
                //->modelClass(MediaCategory::class)
                ->mediaType('video')
                ->acceptMatch('video/*')
                ->typeName('视频')
        );
    }

 	//function toVular(){
	//	return VularNode::make()->becomeTo('div')
	//		->text('Dashboard');
	//}
}