<?php
namespace Water\Vular\Admin\User;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VContainer;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VSwitch;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vular\VularAvatar;
use Water\Vular\Models\Role;

class AdminEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Models\Admin::class;
    protected $newTitle = '新建用户';
    protected $editTitle = '编辑用户';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('系统管理')
                    ->textItem('用户管理')
                    ->textItem('管理员');
        $this->hidden((!user()->isPermitted('users_module')
                    || !user()->isPermitted('admin_setting'))
                    && user()->id != request('id')
        );
    }

    function fields(){
        return [
            VTextField::make()
                ->field('login_name')
                ->label('登录名称')
                ->prependInnerIcon('person')
                ->requried()
                ->loginName()
                ->unique()
                ->hint('中英文字，数字，中划线，下划线构成'),
            VTextField::make()
                ->field('password')
                ->label('密码')
                ->prependInnerIcon('lock')
                ->hint('空表示不修改')
                ->type('password')
                //->minLength(6)
                ->maxLength(20)
                ->empertyIngore()                
                ->showFilter(function($value){
                    return '';
                })
                ->saveFilter(function($value){
                    return bcrypt($value);
                }),
            VTextField::make()
                ->field('name')
                ->prependInnerIcon('title')
                ->requried()
                ->unique()
                ->label('姓名'),
            VularAvatar::make()
                ->field('avatar')
                ->addSize([350,350])
                ->label('头像'),
            VTextField::make()
                ->label('Email')
                ->field('email')
                ->prependInnerIcon('mail')
                ->unique()
                ->requried()
                ->email()
                ->requried(),
            VTextField::make()
                ->field('mobile')
                ->label('手机号')
                ->prependInnerIcon('phone_android'),
            VTextField::make()
                ->field('position')
                ->label('职位')
                ->prependInnerIcon('person_pin'),
            VTextField::make()
                ->field('linkedin')
                ->label('领英')
                ->prependInnerIcon('public'),
            VTextField::make()
                ->field('facebook')
                ->label('Facebook')
                ->prependInnerIcon('public'),
            VTextField::make()
                ->field('twitter')
                ->label('Twitter')
                ->prependInnerIcon('public'),
            VTextArea::make()
                ->field('introduction')
                ->label('简介')
                ->prependInnerIcon('insert_comment'),
            VSwitch::make()
                ->field('forbid')
                ->label('禁用'),
            VSelect::make()
                ->field('roles')
                ->label('角色')
                ->prependInnerIcon('group')
                ->items(Role::all())
                //->belongsToMany()
                ->multiple()
        ];
    }

}