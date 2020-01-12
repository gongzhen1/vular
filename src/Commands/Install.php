<?php

namespace Water\Vular\Commands;

use Illuminate\Console\Command;
use Water\Vular\Models\Admin;
use Hash;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vular:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Vular FrameWork';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Admin::where('login_name','admin')->delete();
        $admin = new Admin;
        $admin->login_name = "admin";
        $admin->name = "Supper Administrator";
        //$admin->email = "you";
        $admin->issupper = true;
        $admin->password = Hash::make('123456');
        $admin->save();

        echo "Installed successfully:\n";
        echo "--Login Url:/vl-admin\n";
        echo "--Login Name:admin\n";
        echo "--Password:123456\n";
    }
    
}

        /*factory('Water\Vular\Models\Admin',1)->create([
            'login_name' => 'admin',
            'name' => 'Supper Administrator',
            'email' => '11011968@qq.com',
            'issupper' => true,
            'password' => Hash::make('123456')
            ]);*/


