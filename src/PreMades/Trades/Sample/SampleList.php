<?php
namespace Water\Vular\PreMades\Trades\Sample;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class SampleList extends DataTablePage{
    protected $title = '样品列表';
    
    function register(){
        parent::register();
        $this->breadcrumbs->textItem('样品管理');
    }
    
    function editPage(){
        return SampleEdit::make();
    }

    function columns(){
        
        return [ 
            //VularTableColumn::make('id','ID'),
            VularTableColumn::make('customers.name','客户')
                ->searchable(),
            VularTableColumn::make('courier','快递公司')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('delivery_date','邮寄时间')
                ->sortable(),
            VularTableColumn::make('status','状态')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('user.name','业务员')
                ->hiddenBy('order_user_column')
        ];

    }

    function onRow($row){
        parent::onRow($row);
        $normalChip = VularNode::make()//VularNode的属性会被赋予单元格
            ->children(VChip::make('正常')
                ->color('light-blue')
                ->textColor('white')
                ->small()
            );
        $forbidChip = VularNode::make()
            ->children(VChip::make('禁用')
                ->color('red')
                ->textColor('white')
                ->small()
            );
       // $row->forbid = $row->forbid ? $forbidChip  : $normalChip;

        //$roleChips = VularNode::make();

        //    \Log::notice(json_encode($roleChips));
        //$row->rolesShow =  $roleChips;
        //return $row;
    }

    function queryBuilder(){
        return \DB::table('samples')
                    ->join('customers', 'customers.id', '=', 'samples.customer_id')
                    ->leftJoin('admins', 'admins.id', '=', 'samples.user_id')
                    ->select('samples.*', 'customers.name as customers.name','admins.name as user.name');
    }

    function appendToQuery($queryBuilder){
        $user = user();
        if($user->isPermitted('sample_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('samples.user_id', $user->id);
    }

    //function rowEditButton($btn, $row){
        //return $btn->hiddenBy('sample_edit')
    //}

    function rowDeleteButton($btn, $row){
        return $btn->hiddenBy('sample_delete');
    }

}