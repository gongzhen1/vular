<?php
namespace Water\Vular\PreMades\Trades\Sample;

use Water\Vular\Admin\Templates\OneColumnFormPage;
use Water\Vular\Elements\Html\Div;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vular\VularTreeSelect;
use Water\Vular\Elements\Vular\VularFormGridCard;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Relations\VularFormHasManyCard;
use Water\Vular\Elements\Vuetify\VSlider;
use Water\Vular\Core\VularResponse;
use Water\Vular\Models\Customer;
use Water\Vular\Models\Supplier;

class SampleEdit extends OneColumnFormPage{

    protected $modelClass = \Water\Vular\Models\Sample::class;

    protected $newTitle = '新建样品';
        
    protected $editTitle = '样品编辑';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('样品');
    }

    function cards(){
        return[
            VularFormGridCard::make()
                ->title('寄样信息')
                ->flex(
                    VSelect::make()
                        ->field('customer')
                        ->label('客户')
                        ->items(Customer::orderBy('name')->get())
                        ->prependInnerIcon('account_box')
                        ->requried(),
                    'xs12'
                )
                ->flex(
                    VSelect::make()
                        ->field('currency')
                        ->label('样品费币种')
                        ->prependInnerIcon('monetization_on')
                        ->items([
                            ['id'=>'Dollar', 'name'=>'美元'], 
                            ['id'=>'Euro', 'name'=>'欧元'], 
                            ['id'=>'RMB', 'name'=>'人民币'],
                            ['id'=>'-', 'name'=>'免费']
                        ])
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('collection_amount')
                        ->label('金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('exchange_rate')
                        ->label('汇率')
                        ->prependInnerIcon('trending_up')
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VSelect::make()
                        ->field('courier')
                        ->label('快递公司')
                        ->prependInnerIcon('contact_mail')
                        ->items(['DHL','TNT','EMS','罗娜代理','其它']),
                    'xs12'
                )
                ->flex(
                    VTextField::make()
                        ->field('delivery_date')
                        ->label('邮寄日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('tracking_number')
                        ->label('单号')
                        ->prefix("#")
                        ->maxLength(20),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('fee')
                        ->label('费用')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs6'
                )
                ->flex(
                    VSelect::make()
                        ->field('status')
                        ->label('状态')
                        ->prependInnerIcon('airport_shuttle')
                        ->items(['待发','已发','已达','出错']),
                    'xs6'
                )
                ->flex(
                    VTextArea::make()
                        ->field('details')
                        //->prependInnerIcon('description')
                        ->label('详情')
                        ->rows(3)
                        ->maxLength(500),
                    'xs12'
                )
                ,
            VularFormHasManyCard::make()
                ->title('样品来源')
                ->field('factorySamples')
                ->flex(
                    VSelect::make()
                        ->field('supplier')
                        ->label('工厂')
                        ->items(Supplier::orderBy('name')->get())
                        ->prependInnerIcon('portrait')
                        //->belongsTo()
                        ->requried(),
                    'xs12'
                )
                ->flex(
                    VTextField::make()
                        ->field('recieved_date')
                        ->label('收样日期')
                        ->prependInnerIcon('today')
                        ->type('date'),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('batch_no')
                        ->label('批号')
                        ->prefix('#')
                        ->maxLength(20),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('sample_fee')
                        ->prependInnerIcon("attach_money")
                        ->label('样品费')
                        ->float(),
                    'xs12'
                )
                ->flex(
                    VTextArea::make()
                        ->field('details')
                        ->label('详情')
                        ->rows(3)
                        ->maxLength(500),
                    'xs12'
                )
                
        ];
    }

    function beforeSave($dbModel){
        if(!$dbModel->id){
            $dbModel->user()->associate(user());
        }
        return $dbModel;
    }

}