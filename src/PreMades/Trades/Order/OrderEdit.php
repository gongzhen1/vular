<?php
namespace Water\Vular\PreMades\Trades\Order;

use Water\Vular\Admin\Templates\OneColumnFormPage;
use Water\Vular\Elements\Html\Div;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vular\VularTreeSelect;
use Water\Vular\Elements\Vular\VularFormGridCard;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Relations\VularFormHasManyCard;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vuetify\VSlider;
use Water\Vular\Core\VularResponse;
use Water\Vular\Models\Customer;
use Water\Vular\Models\Supplier;

class OrderEdit extends OneColumnFormPage{

    protected $modelClass = \Water\Vular\Models\Order::class;

    protected $newTitle = '新建订单';
        
    protected $editTitle = '订单编辑';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('订单');
        //$dbModel = $this->dbModel();
        $this->bottomButton(
            VBtn::make(trans('vular.finished'))
                ->large()
                ->round()
                ->light()
                ->valid()
                ->color('orange')
                //->disabled(!$dbModel || ($dbModel&&$dbModel->passed))
                ->hiddenBy('order_pass')
                //->disabledBy('order_pass')
                ->click(
                    VularAction::make()
                        ->action('pass')
                        ->post()
                        ->valid()
                        ->bindsTo($this->form)
                )            
        );

        //$this->permitActionBy('save','order_save');
        //$this->permitActionBy('saveAndContinue','order_save');

    }

    function cards(){
        return[
            VularFormGridCard::make()
                ->title('客户合同')
                ->flex(
                    VSelect::make()
                        ->field('customer')
                        ->label('客户')
                        ->items($this->customers())
                        ->prependInnerIcon('account_box')
                        //->belongsTo()
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('cotract_date')
                        ->label('合同日期')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('cotract_no')
                        ->label('合同号')
                        ->prefix("#")
                        ->requried()
                        ->unique()
                        ->maxLength(20),
                    'xs4'
                )
                ->flex(
                    VSelect::make()
                        ->field('payment_mode')
                        ->label('付款方式')
                        ->prependInnerIcon('payment')
                        ->items(['T/T 100%/0%','T/T 30%/70%','T/T 20%/80%','T/T 10%/90%','T/T 0%/100%','LC at sight', 'DP at sight'])
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VSelect::make()
                        ->field('currency')
                        ->label('币种')
                        ->prependInnerIcon('monetization_on')
                        ->items([
                            ['id'=>'Dollar', 'name'=>'美元'], 
                            ['id'=>'Euro', 'name'=>'欧元'], 
                            ['id'=>'RMB', 'name'=>'人民币']
                        ])
                        ->requried()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('contract_amount')
                        ->label('合同金额')
                        ->prependInnerIcon("attach_money")
                        ->float()
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextArea::make()
                        ->field('goods_description')
                        //->prependInnerIcon('description')
                        ->label('货物描述')
                        ->rows(3)
                        ->requried(),
                    'xs12'
                )
                ->flex(
                    VTextField::make()
                        ->field('estimated_shipping_date')
                        ->label('预计发货日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs3'
                )
                ->flex(
                    VTextField::make()
                        ->field('estimated_arrival_date')
                        ->label('预计到港日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs3'
                )
                ->flex(
                    VTextField::make()
                        ->field('shipping_date')
                        ->label('实际发货日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs3'
                )
                ->flex(
                    VTextField::make()
                        ->field('arrival_date')
                        ->label('实际到港日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs3'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_collection_date')
                        ->label('第一次收汇日期')
                        ->prependInnerIcon("today")
                        ->type('date'),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_collection_amount')
                        ->label('第一次收汇金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_exchange_rate')
                        ->label('结汇汇率')
                        ->prependInnerIcon('trending_up')
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_collection_date')
                        ->label('第二次收汇日期')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_collection_amount')
                        ->label('第二次收汇金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_exchange_rate')
                        ->label('结汇汇率')
                        ->prependInnerIcon('trending_up')
                        ->float()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextArea::make()
                        ->field('remarks')
                        ->label('备注')
                        ->rows(2),
                    'xs12'
                )
                ,
            VularFormHasManyCard::make()
                ->title('工厂合同')
                ->field('factoryOrders')
                ->flex(
                    VSelect::make()
                        ->field('supplier')
                        ->label('工厂')
                        ->items(Supplier::orderBy('name')->get())
                        ->prependInnerIcon('portrait')
                        //->belongsTo()
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('cotract_date')
                        ->label('合同日期')
                        ->prependInnerIcon('today')
                        ->type('date')
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('cotract_no')
                        ->label('合同号')
                        ->prefix('#')
                        ->requried()
                        ->unique()
                        ->maxLength(20),
                    'xs4'
                )
                ->flex(
                    VSelect::make()
                        ->field('payment_mode')
                        ->label('付款方式')
                        ->prependInnerIcon('payment')
                        ->items(['T/T 100%/0%','T/T 30%/70%','T/T 20%/80%','T/T 10%/90%','T/T 0%/100%'])
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VSelect::make()
                        ->field('currency')
                        ->label('币种')
                        ->prependInnerIcon('monetization_on')
                        ->items([
                            ['id'=>'RMB', 'name'=>'人民币'],
                            ['id'=>'Dollar', 'name'=>'美元'],
                            ['id'=>'Euro', 'name'=>'欧元']
                        ])
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('contract_amount')
                        ->prependInnerIcon("attach_money")
                        ->label('合同金额')
                        ->float()
                        ->requried(),
                    'xs4'
                )
                ->flex(
                    VTextArea::make()
                        ->field('goods_description')
                        ->label('货物描述')
                        ->rows(3)
                        ->maxLength(500)
                        ->requried(),
                    'xs12'
                )
                ->flex(
                    VTextField::make()
                        ->field('estimated_delivery_date')
                        ->label('预计发货时间')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('delivery_date')
                        ->label('实际发货时间')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_pay_date')
                        ->label('第一次付款日期')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_pay_amount')
                        ->label('第一次付款金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('first_pay_exchange_rate')
                        ->label('汇率')
                        ->prependInnerIcon('trending_up')
                        ->float()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_pay_date')
                        ->label('第二次付款日期')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_pay_amount')
                        ->label('第二次付款金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('second_pay_exchange_rate')
                        ->label('汇率')
                        ->prependInnerIcon('trending_up')
                        ->float()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('export_rebate')
                        ->label('退税金额')
                        ->prependInnerIcon("attach_money")
                        ->float(),
                    'xs12'
                )
                ->flex(
                    VTextArea::make()
                        ->field('remarks')
                        ->label('备注')
                        ->maxLength(500)
                        ->rows(2),
                    'xs12'
                ),
            VularFormHasManyCard::make('table')
                ->title('订单费用')
                ->field('fees')
                ->flex(
                    VTextField::make()
                        ->field('pay_date')
                        ->label('付款日期')
                        ->prependInnerIcon("today")
                        ->type('date')
                        ,
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('name')
                        ->label('名称')
                        ->prependInnerIcon('payment')
                        ->requried()
                        ,
                    'xs6'
                )
                ->flex(
                    VSelect::make()
                        ->field('currency')
                        ->label('币种')
                        ->prependInnerIcon('monetization_on')
                        ->items([
                            ['id'=>'RMB', 'name'=>'人民币'],
                            ['id'=>'Dollar', 'name'=>'美元'], 
                            ['id'=>'Euro', 'name'=>'欧元']
                        ])
                        ->requried()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('amount')
                        ->label('金额')
                        ->prependInnerIcon("attach_money")
                        ->requried()
                        ->float()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextField::make()
                        ->field('exchange_rate')
                        ->label('汇率')
                        ->prependInnerIcon('trending_up')
                        ->float()
                        ,
                    'xs4'
                )
                ->flex(
                    VTextArea::make()
                        ->field('remarks')
                        ->label('备注')
                        ->rows(2)
                        ,
                    'xs12'
                )
                ,
            VularFormGridCard::make()
                ->title('提成核算')
                ->flex(
                    VTextField::make()
                        //->field('xxx')
                        ->label('毛利')
                        ->disabled()
                        ->defaultValue(number_format($this->grossProfit(),2)),
                    'xs6'
                )
                ->flex(
                    VSlider::make()
                        ->field('royalty_rate')
                        ->label('提成比例')
                        ->thumbLabel('always')
                        ->step(5),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        //->field('')
                        ->label('应付提成')
                        ->disabled()
                        ->defaultValue(number_format($this->royalty(),2)),
                    'xs6'
                )
                ->flex(
                    VTextField::make()
                        ->field('royalty_amount')
                        ->label('实付提成')
                        ->float(),
                    'xs6'
                )
                
        ];
    }

    function pass($viewModel){
        return $this->doSave($viewModel, function($dbModel){
                $dbModel->passed = true;
            })
            ->success()
            ->closePage();
    }

    function beforeSave($dbModel){
        $dbModel->passed = false;
        if(!$dbModel->id){
            $dbModel->user()->associate(user());
        }
        return $dbModel;
    }

    function customers(){
        $user = user();
        if($user->isPermitted('customer_all_data')){
            return Customer::orderBy('name')->get();
        }
        return Customer::where('user_id', $user->id)->orderBy('name')->get();
    }


    //计算毛利
    protected function grossProfit($model = null){
        if(!$this->modelId()){
            return 0;
        }

        $model = $model ? $model : $this->dbModel();

        //<----------------
        //已收RMB账款
        $firstRmbAmount =  $model->first_exchange_rate? $model->first_collection_amount * $model->first_exchange_rate: $model->first_collection_amount;

        $secondRmbAmount =  $model->second_exchange_rate? $model->second_collection_amount * $model->second_exchange_rate: $model->second_collection_amount;

        $collectionRmbAmount = $firstRmbAmount + $secondRmbAmount;
        //<------------

        //已付RMB货款
        $rmbPayment = 0;
        foreach ($model->factoryOrders as $factoryOrder) {
            $firstPayment = $factoryOrder->first_pay_exchange_rate? $factoryOrder->first_pay_amount * $factoryOrder->first_pay_exchange_rate : $factoryOrder->first_pay_amount;
            $secondPayment = $factoryOrder->second_pay_exchange_rate? $factoryOrder->second_pay_amount * $factoryOrder->second_pay_exchange_rate : $factoryOrder->second_pay_amount;

            $rmbPayment += ($firstPayment + $secondPayment - $factoryOrder->export_rebate);
        }

        //已付RMB费用
        $rmbFee = 0;
        foreach ($model->fees as $fee) {
            $feeAmount = $fee->exchange_rate ? $fee->amount * $fee->exchange_rate : $fee->amount;

            $rmbFee += $feeAmount;
        }

        return   $collectionRmbAmount - $rmbPayment - $rmbFee;
    }

    //己算提成
    protected function royalty(){
        if(!$this->modelId()){
            return 0;
        }
        $model = $this->dbModel();

        return ($this->grossProfit($model) * $model->royalty_rate)/100;
    }

    protected function modelId(){
        return request('id');
    }

    protected function dbModel(){
        $modelClass =$this->modelClass;
        //\Log::notice($modelClass);
        return $modelClass::find($this->modelId());
    }

}