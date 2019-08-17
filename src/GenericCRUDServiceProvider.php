<?php

namespace PatilVishalVS\GenericCRUD;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use PatilVishalVS\GenericCRUD\ResourceRegistrar;

class GenericCRUDServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $DS = DIRECTORY_SEPARATOR;
        $package_dir = dirname(dirname(__FILE__));
        
        //Register delete router
        $registrar = new ResourceRegistrar($this->app['router']);
        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
            return $registrar;
        });
        
        // Load web routes
        $this->loadRoutesFrom($package_dir. $DS .'routes'.$DS .'web.php');
        
        // Load database migrations
        $this->loadMigrationsFrom($package_dir. $DS .'migrations');
        
        // publish views
        $this->publishes([
            $package_dir.$DS.'views' => resource_path('views'.$DS.'vendor'.$DS.'generic'),
        ]);
        
        $this->publishes([
          $package_dir.$DS.'/css' => public_path('vendor/generic/css'),
        ], 'public');
        
        // Register actionlink directive
        Blade::include('generic.components.action-link', 'actionlink');
        
    }
}
