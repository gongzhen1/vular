<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VSelect;

class SupplierEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Models\Supplier::class;
    protected $newTitle = '新建供应商';
    protected $editTitle = '编辑供应商';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('供应商');
        $this->saveBtn()->disabledBy('supplier_save');

    }

    function fields(){
        return [
            VTextField::make()
                ->field('name')
                ->label('名称')
                ->requried()
                ->unique()
                ->maxLength('100'),
            VTextField::make()
                ->label('英文名')
                ->field('name_en')
                ->maxLength('10'),
            VTextArea::make()
                ->label('主营产品')
                ->field('products')
                ->maxLength('1000'),
            VTextField::make()
                ->field('contact')
                ->label('联系人')
                ->maxLength('50'),
            VTextField::make()
                ->field('email')
                ->label('邮箱')
                ->email()
                ->maxLength('50'),
            VTextField::make()
                ->field('tel')
                ->label('电话')
                ->maxLength('50'),
            VTextField::make()
                ->field('website')
                ->label('网址')
                ->maxLength('100'),
            VTextArea::make()
                ->label('备注')
                ->field('remarks')
                ->maxLength('1000')
        ];
    }

    function beforeSave($dbModel){
        if(!$dbModel->id){
            $dbModel->user()->associate(user());
        }
        return $dbModel;
    }

}