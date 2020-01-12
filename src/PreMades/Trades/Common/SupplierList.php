<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class SupplierList extends DataTablePage{
    protected $title = '供应商列表';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('订单管理')
                    ->textItem('供应商');

    }

    function editPage(){
        return SupplierEdit::make();
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('name', '名称')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('products', '主营产品')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('contact', '联系人')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('created_at','创建时间')
                ->sortable(),
            VularTableColumn::make('user.name','业务员')
        ];

    }

    function rowEditButton($btn, $row){
        //$btn->hiddenBy('supplier_edit')
        //\Log::notice(!user()->isPermitted('supplier-can-edit-all'));
        //\Log::notice(user()->id . "--" .$row->user->id);
        return $btn->disabled(!user()->isPermitted('supplier-can-edit-all') && user()->id != $row->user->id);
    }

    function rowDeleteButton($btn, $row){
        return $btn->hiddenBy('supplier_delete');
    }

}