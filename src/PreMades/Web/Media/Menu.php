<?php
namespace Water\Vular\PreMades\Web\Media;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        //$this->node(function($node){
            //$node->becomeToSubheader('网站');
        //});
        $this->node(function($node){
            $node->becomeToGroup(trans('vular.media-lib'))
                ->icon('perm_media')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.image-mangement'))
                    ->to(ImagesPage::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.video-mangement'))
                    ->to(VideosPage::make());
                })
                ;
        });

	}

}