<?php
namespace Water\Vular\PreMades\Trades\Sample;

use Water\Vular\Admin\Permission\Segment as PermissionSegment;

class Permission extends PermissionSegment{

    function build(){

        $this->node(function($node){
            $node->name('样品管理')
                 ->authPoint('sample_module', '模块可见')
                 ->authPoint('sample_all_data', '全部数据可见')
                 ->authPoint('sample_delete', '删除')
                 ->authPoint('sample_edit', '编辑')
                 ->authPoint('sample_save', '保存');
        });

    }

}