<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class AdminList extends DataTablePage{
    protected $title = '管理员列表';
    
    function editPage(){
        return AdminEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('系统管理')
                    ->textItem('用户管理')
                    ->textItem('管理员');
        $this->hiddenBy('users_module');
        $this->hiddenBy('admin_setting');
    }

    function columns(){
        
        return [ 
            //VularTableColumn::make('id','ID'),
            VularTableColumn::make('login_name','登录名')
                ->searchable(),
            VularTableColumn::make('name', '名称')
                ->sortable()
                ->searchable(),
            VularTableColumn::make('email', '邮箱')
                ->sortable()
                ->searchable(),
                //->class('text-xs-right'),
                //->class('text-xs-right'),

            VularTableColumn::make('forbid','状态'),
            VularTableColumn::make('rolesShow','角色'),
            VularTableColumn::make('created_at','时间')
                ->sortable()
                //->classes('text-xs-right')
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
        $row->forbid = $row->forbid ? $forbidChip  : $normalChip;

        $roleChips = VularNode::make();

        foreach ($row->roles as $role) {
            $roleChips->children(
                VChip::make($role->name)
                //->color("transparent")
                ->small()
            );

        }
        //    \Log::notice(json_encode($roleChips));
        $row->rolesShow =  $roleChips;
        //return $row;
    }


}