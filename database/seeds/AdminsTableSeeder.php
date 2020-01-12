<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Water\Vular\Models\Admin',1)->create([
            'login_name' => 'admin',
            'name' => '超级管理员',
            'email' => '11011968@qq.com',
            'issupper' => true,
            'password' => Hash::make('123456')
            ]);

        //factory('Plugoo\FrameWork\Models\Admin',21)->create([
        //    'password' => Hash::make('123456')
        //    ]);
    }
}
