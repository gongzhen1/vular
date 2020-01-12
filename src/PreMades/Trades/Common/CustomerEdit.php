<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vular\VularCountry;

use Water\Vular\Models\Role;

class CustomerEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Models\Customer::class;
    protected $newTitle = '新建客户';
    protected $editTitle = '编辑客户';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('客户');
        $this->saveBtn()->disabledBy('customer_save');

    }

    function fields(){
        return [
            VTextField::make()
                ->field('name')
                ->label('名称')
                ->requried()
                ->unique()
                ->maxLength('100'),
            VularCountry::make()
                ->field('country')
                ->label('国家'),
            VTextArea::make()
                ->label('收货地址')
                ->field('cargo_address')
                ->maxLength('500'),
            VTextArea::make()
                ->label('快递地址')
                ->field('sample_address')
                ->maxLength('500'),
            VTextField::make()
                ->field('contact')
                ->label('联系人')
                ->maxLength('50'),
            VTextField::make()
                ->field('email')
                ->type('email')
                ->label('邮箱')
                ->email()
                ->maxLength('50'),
            VTextField::make()
                ->field('tel')
                ->label('电话')
                ->maxLength('50')
        ];
    }

    function beforeSave($dbModel){
        if(!$dbModel->id){
            $dbModel->user()->associate(user());
        }
        return $dbModel;
    }

}