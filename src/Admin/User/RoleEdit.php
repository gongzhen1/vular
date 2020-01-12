<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vular\VularTreeSelect;

class RoleEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Models\Role::class;
    protected $newTitle = '新建角色';
    protected $editTitle = '角色编辑';


    function register(){
        parent::register();
        $this->breadcrumbs->textItem('系统管理')
                    ->textItem('用户管理')
                    ->textItem('角色');

    }

    function fields(){
        return [
            VTextField::make()
                ->field('name')
                ->label('角色名')
                ->requried()
                ->unique()
                ->maxLength(20),
            VTextArea::make()
                ->field('description')
                ->label('描述')
                ->rows(3)
                ->maxLength('500'),
            VularTreeSelect::make()
                ->field('permissions')
                ->label('权限选择')
                ->flat()
                ->tile()
                ->activatable()
                ->selectable()
                ->hoverable()
                ->openOnClick()
                ->items($this->permissions())
                ->itemKey('slug')
                ->style('border-bottom','solid #bbb 1px')
                ->showFilter(function($value){
                    return explode(",", $value);
                })
                ->saveFilter(function($value){
                    $value = array_filter($value, function($slug){
                        return ($slug & 'vular-per-group-') !== 'vular-per-group-';
                    });
                    return implode(",", $value);
                }),
            VSwitch::make()
                ->field('forbid')
                ->label('禁用')
        ];
    }


    function permissions(){
        $permissions = [];
        $permissionClasses = config('vular-admin.permissions');
        foreach ($permissionClasses as $permissionClass) {
           $permissions = array_merge_recursive($permissions, (new $permissionClass)->toNodes());
        }
        return $permissions;
    }

}