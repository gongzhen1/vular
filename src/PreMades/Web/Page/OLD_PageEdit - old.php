<?php
namespace Water\Vular\PreMades\Web\Page;

use Water\Vular\Admin\Templates\OneColumnFormPage;
use Water\Vular\Elements\Vular\VularEditor;
use Water\Vular\Elements\Vular\VularFormGridCard;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;

class OLD_PageEdit extends OneColumnFormPage{
    protected $modelClass = \Water\Vular\Models\Page::class;
    protected $newTitle = '新建页面';
    protected $editTitle = '编辑页面';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('页面');
    }

    function cards(){
        return[

                VularEditor::make()
                    ->field('customer')
                    ->label('客户')
        ];
    }
}