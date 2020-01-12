<?php
namespace Water\Vular\PreMades\Trades\Order;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
//use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class OrderList extends DataTablePage{
    protected $title = '订单列表';

    function editPage(){
        return OrderEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('订单');

        $this->filter(TableFilter::make()
                ->item(function($item){
                    $item->input(
                            VTextField::make()
                                ->field('startTime')
                                ->type('date')
                                ->label('最早合同日期')
                        )
                        ->field('cotract_date')
                        ->min()
                        ->halfWidth();
                        //->field('name')
                })
                ->item(function($item){
                    $item->input(
                            VTextField::make()
                                ->type('date')
                                ->field('endTime')
                                ->label('最晚合同日期')
                        )
                        ->field('cotract_date')
                        ->max()
                        ->halfWidth();
                        //->field('name')
                })
            );

        $this->batchMenu()->itemOfDelete()->hiddenBy('order_delete');
    }

  
    function columns(){
        
        return [ 
            //VularTableColumn::make('id','ID'),
            VularTableColumn::make('cotract_no', '合同号')
                ->sortable()
                ->searchable(),
                //->class('text-xs-right'),
            VularTableColumn::make('customers.name','客户')
                ->sortable()
                ->searchable(),
                //->class('text-xs-right'),
            VularTableColumn::make('contract_amount','合同金额')
                ->sortable(),
            //VularTableColumn::make('collection_value','已收账款'),
            VularTableColumn::make('collection_percent','收款比例')
                ->sortable(),
            VularTableColumn::make('royalty_amount','已付提成')
                ->sortable(),

            VularTableColumn::make('cotract_date','合同日期')
                ->sortable(),
            VularTableColumn::make('passed','状态')
                ->sortable(),
            VularTableColumn::make('user','业务员')
                ->hiddenBy('order_user_column')
                ->sortable(),
        ];

    }

    function onRow($row){
        parent::onRow($row);
        $normalChip = VularNode::make()//VularNode的属性会被赋予单元格
            ->children(VChip::make('完成')
                ->light()
                ->textColor('white')
                ->small()
            );
        $waitingChip = VularNode::make()
            ->children(VChip::make('未完成')
                ->color('red')
                ->textColor('white')
                ->small()
            );
        //\Log::notice(json_encode($row));
        $row->passed = $row->passed ? $normalChip  : $waitingChip;
        $row->collection_percent = number_format($row->collection_percent,0);
        $row->collection_percent = $row->collection_percent > 99?100: $row->collection_percent;
        $row->collection_percent = $row->collection_percent . '%';
    }

    function queryBuilder(){
        return \DB::table('orders')
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->leftJoin('admins', 'admins.id', '=', 'orders.user_id')
                    ->select('orders.*','customers.name as customers.name','admins.name as user')
                    ->selectRaw(' 
                           (orders.first_collection_amount + ifnull(orders.second_collection_amount,0))*100/orders.contract_amount as collection_percent
                        '
                    );
    }

    function appendToQuery($queryBuilder){
        $queryBuilder->orderBy('passed','asc')
                            ->orderBy('cotract_date','desc');
        $user = user();
        if($user->isPermitted('order_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('orders.user_id', $user->id);

    }


    function rowEditButton($btn, $row){
        //$btn->hiddenBy('order_edit')
        return $btn->disabled($row->passed && !user()->isPermitted('order_edit_passed'));
    }

    function rowDeleteButton($btn, $row){
        return $btn->hiddenBy('order_delete');
    }

}