<?php
namespace Water\Vular\PreMades\Trades\Order;

use Water\Vular\Admin\Permission\Segment as PermissionSegment;

class Permission extends PermissionSegment{

    function build(){

        $this->node(function($node){
            $node->name('订单管理')
                 ->authPoint('order_module', '模块可见')
                 ->authPoint('order_all_data', '全部数据可见')
                 ->authPoint('order_edit_passed', '编辑完成订单')
                 ->authPoint('order_user_column', '显示业务员列')
                 ->authPoint('order_delete', '删除')
                 ->authPoint('order_edit', '编辑')
                 ->authPoint('order_save', '保存')
                 ->authPoint('order_pass', '审核');
        });

    }

}