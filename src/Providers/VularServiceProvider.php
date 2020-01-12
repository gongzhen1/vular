<?php 

namespace Water\Vular\Providers;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Water\Vular\Commands\Install;

class VularServiceProvider extends ServiceProvider {

    protected $namespace = 'Water\Vular\Http\Controllers';
    protected $baseDir = '';


    public function boot() 
    {
        $this->app->booted(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group($this->baseDir . 'routes/web.php');

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group($this->baseDir . 'routes/api.php');
        });

        //$this->loadMigrationsFrom(__DIR__.'/path/to/migrations');

        //$this->loadTranslationsFrom($this->baseDir . 'resources/lang', 'vular');

        /*Load migrations*/
        //$this->loadMigrationsFrom($this->baseDir . 'database/migrations');
        $this->loadViewsFrom($this->baseDir . 'resources/views', 'vular');

        $this->loadMigrationsFrom($this->baseDir.'database/migrations/');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class
            ]);
        }


        $this->publishes([
            $this->baseDir.'public/css' => public_path('vular/css'),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/js' => public_path('vular/js'),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/images' => public_path('vular/images'),
        ], 'public');

        $this->publishes([
            $this->baseDir.'public/fonts' => public_path('fonts'),
        ], 'public');

        //$this->publishes([
        //    $this->baseDir.'database/migrations/' => database_path('migrations')
        //], 'migrations');

        $this->publishes([
            $this->baseDir.'database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            $this->baseDir.'database/factories/' => database_path('factories')
        ], 'factories');

        $this->publishes([
            $this->baseDir.'resources/lang/' => resource_path('lang'),
        ]);

        $this->publishes([
            $this->baseDir.'config/vular-admin.php' => config_path('vular-admin.php'),
        ]);
        
        //if (! $this->app->configurationIsCached()) {
            //$this->mergeConfigFrom(
            //    __DIR__.'/../../config/auth.php', 'auth'
            //);
        //}

      
     }


    public function register()
    {
        $this->baseDir = __DIR__ .'/../../';
        $router = $this->app['router'];
        //$router->aliasMiddleware('auth.admin', \Water\Vular\Http\Middleware\Authenticate::class);
        //$router->prependMiddlewareToGroup('api',
        //    \App\Http\Middleware\EncryptCookies::class
        //);
        //$router->prependMiddlewareToGroup('api',
        //    \Illuminate\Session\Middleware\StartSession::class
        //);
    }


}   