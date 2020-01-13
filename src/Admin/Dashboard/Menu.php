<?php
namespace Water\Vular\Admin\Dashboard;

use Water\Vular\Admin\Menu\Segment as MenuSegment;
use Water\Vular\Admin\Pages\DashboardPage;

class Menu extends MenuSegment{

	function build(){

		$this->node(function($node){
			$node->becomeToTile(trans('vular.dashboard'))
                ->icon('dashboard')
                ->to(Page::make());
		});

	}

}