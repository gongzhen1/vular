<?php

return [
    'guard' => 'admin',

    'menus'=>[
        Water\Vular\PreMades\Trades\Dashboard\Menu::class,
        Water\Vular\PreMades\Web\Page\Menu::class,
        //Water\Kingnod\Form\Menu::class,
        //Water\TestPools\Form\Menu::class,
        //Water\Harvest\Form\Menu::class,
        //Water\Harvest\Customer\Menu::class,
        Water\Vular\PreMades\Web\Post\Menu::class,
        Water\Vular\PreMades\Web\Product\Menu::class,
        Water\Vular\PreMades\Web\Media\Menu::class,
        //Water\Vular\PreMades\Trades\Order\Menu::class,
        //Water\Vular\PreMades\Trades\Sample\Menu::class,
        //Water\Vular\PreMades\Trades\Common\Menu::class,
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