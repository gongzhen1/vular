<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Admin\TableFilter;

class RoleList extends DataTablePage{
    protected $title = '角色列表';

    function editPage(){
        return RoleEdit::make();
    }

    function register(){
        parent::register();
        $this->hiddenBy('roles_module');
        $this->hiddenBy('admin_setting');
        $this->breadcrumbs->textItem('系统管理')
                    ->textItem('用户管理')
                    ->textItem('角色');

        $this->filter(TableFilter::make()
                ->item(function($item){
                    $item->input(
                            VTextField::make()
                                ->field('nameOnFilter')
                                ->label('角色名')
                        )
                        ->field('name')
                        ->like("%{0}%")
                        ->fullWidth();
                        //->field('name')
                })
                ->item(function($item){
                    $item->input(
                            VSwitch::make()
                                ->field('forbid')
                                ->label('禁用')
                        )
                        ->equal()
                        ->field('forbid')
                        ->oneThirdWidth();
               })
                ->item(function($item){
                    $item->input(
                            VSwitch::make()
                                ->field('notforbid')
                                ->label('正常')
                        )
                        ->notEqual()
                        ->field('forbid')
                        ->oneThirdWidth();
               })
                ->item(function($item){
                    $item->input(
                            VTextField::make()
                                ->field('startTime')
                                ->type('date')
                                ->label('最早创建日期')
                        )
                        ->field('created_at')
                        ->min()
                        ->halfWidth();
                        //->field('name')
                })
                ->item(function($item){
                    $item->input(
                            VTextField::make()
                                ->type('date')
                                ->field('endTime')
                                ->label('最晚创建日期')
                        )
                        ->field('created_at')
                        ->max()
                        ->halfWidth();
                        //->field('name')
                })
            );

    }

  
    function columns(){
        
        return [ 
            //VularTableColumn::make('id','ID'),
            VularTableColumn::make('name', '角色名')
                ->sortable()
                ->searchable(),
                //->class('text-xs-right'),
            VularTableColumn::make('description','描述')
                ->searchable(),
                //->class('text-xs-right'),

            VularTableColumn::make('forbid','状态'),
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
        $row->description = VularNode::make($row->description);//->style('color','red');
        //return $row;
    }
}