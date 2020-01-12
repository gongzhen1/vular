<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class CustomerList extends DataTablePage{
    protected $title = '客户列表';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('客户');
    }

    function editPage(){
        return CustomerEdit::make();
    }

    function columns(){
        
        return [ 
            //VularTableColumn::make('id','ID'),
            VularTableColumn::make('name', '名称')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('country', '国家')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('contact', '联系人')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('email', '邮箱')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('created_at','创建时间')
                ->sortable(),
            VularTableColumn::make('user.name','业务员')
                ->hiddenBy('order_user_column')
                //->classes('text-xs-right')
        ];

    }

    function rowDeleteButton($btn, $row){
        return $btn->hiddenBy('customer_delete');
    }

    function appendToQuery($queryBuilder){
        $user = user();
        if($user->isPermitted('customer_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('customers.user_id', $user->id);
    }

}