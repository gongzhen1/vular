<?php

return [
    'guard' => 'admin',

    'menus'=>[
        Water\Vular\Admin\Dashboard\Menu::class,
        Water\Vular\Webadmin\Media\Menu::class,
        Water\Vular\Admin\User\Menu::class,
        Water\Vular\Admin\Settings\Menu::class
    ],

    'permissions'=>[
        //Water\Vular\PreMades\Trades\Order\Permission::class,
        //Water\Vular\PreMades\Trades\Sample\Permission::class,
        //Water\Vular\PreMades\Trades\Common\Permission::class,
        //Water\Vular\Admin\User\Permission::class,
    ],
    //'admin-config'=>'harvest',
    'admin-config'=>'warmy',
    //'admin-config'=>'testpools',
];