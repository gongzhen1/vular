<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Permission\Segment as PermissionSegment;

class Permission extends PermissionSegment{

    function build(){

        $this->node(function($node){
            $node->name('系统管理')
                ->authPoint('admin_setting', '模块可见')
                ->child(function($child){
                    $child->name('用户管理')
                        ->authPoint('users_module', '模块可见')
                        ->authPoint('users_delete', '删除')
                        ->authPoint('users_edit', '编辑')
                        ->authPoint('users_save', '保存');
                })
                ->child(function($child){
                    $child->name('角色管理')
                        ->authPoint('roles_module', '模块可见')
                        ->authPoint('role_delete', '删除')
                        ->authPoint('role_edit', '编辑')
                        ->authPoint('role_save', '保存');

                })
                ;
        });

    }

}