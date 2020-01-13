<?php 

namespace Water\Vular\Providers;

use Illuminate\Support\ServiceProvider;

class VularBaseServiceProvider extends ServiceProvider {

    protected $baseDir = '';

    
    protected function registerMenuItem($item){
        $menus = config('vular.menus');
        $position = sizeof($menus) - 2;
        if(array_search($item, $menus)){
            return;
        }
        $position = $position < 0 ? 0 : $position;
        array_splice($menus, $position, 0, [$item]);
        config(['vular.menus' => $menus]);
    }
}   