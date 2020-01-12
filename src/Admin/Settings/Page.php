<?php
namespace Water\Vular\Admin\Settings;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VCheckbox;

class Page extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Models\Setting::class;

    function initialize(){
        $this->title = '系统设置';
        $this->breadcrumbs->textItem('系统管理')
                    ->textItem('系统设置');

    }

    function fields(){
    	return [
    		VTextField::make()
                ->field('name')
    			->label('Name'),
                //->error()
                //->errorMessages(['错误了啊','真错了']),
    		VTextField::make()
    			->label('Email')
                ->field('email')
    			->rule("v => !!v || 'Name is required'")
                ->rule("v => v.length <= 50 || '名称必须少于50个字符'"),
    		VTextField::make()
                ->field('haha'),
    		VTextField::make()
                ->field('email'),
    		VCheckbox::make()
    			->label('哈哈')
                ->field('haha')
    	];
    }


}