Vular， 基于Vuetify跟Laravel实现的，拼插式应用集成框架。像搭积木一样，拼插你的应该用。  
安装：
复制：.env, composer.json, app.php, auth.php, filesystems.php

php artisan cache:clear
php artisan config:clear

php artisan migrate
php artisan passport:install
php artisan vular:install

php artisan vendor:publish --provider="Water\Vular\Providers\VularServiceProvider" --force

Vuetify + Laravel开发的应用程序框架。
本程序正在改版，请不要下载。
