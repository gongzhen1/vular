<?php
namespace Water\Vular\PreMades\Trades\Common;

use Water\Vular\Admin\Permission\Segment as PermissionSegment;

class Permission extends PermissionSegment{

    function build(){
        $this->node(function($node){
            $node->name('客户管理')
                ->authPoint('customer_module', '模块可见')
                ->authPoint('customer_all_data', '全部数据可见')
                ->authPoint('customer_delete', '删除')
                ->authPoint('customer_edit', '编辑')
                ->authPoint('customer_save', '保存');
        })
        ->node(function($node){
            $node->name('供应商管理')
                ->authPoint('supplier_module', '模块可见')
                ->authPoint('supplier_delete', '删除')
                ->authPoint('supplier_edit', '编辑')
                ->authPoint('supplier_save', '保存');
        });

    }

}