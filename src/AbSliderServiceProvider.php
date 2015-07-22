<?php namespace webvolant\abslider;

use Illuminate\Support\ServiceProvider;


class AbSliderServiceProvider extends ServiceProvider {


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/../views', 'abslider');

        $this->publishes([
            __DIR__.'/../public/' => public_path('webvolant/abslider'),
        ], 'public');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('config.php'),
        ], 'config'); //config('config.path');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('/migrations')
        ], 'migrations');

        /*
         * Register the service provider for the dependency.
         */
        $this->app->register('\Collective\Html\HtmlServiceProvider');
        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');

        //app('router')->middleware('Checku', 'webvolant\abadmin\Http\Middleware\Checku');
        //$this->app->register('\Witty\LaravelDbBackup\DBBackupServiceProvider');

        /*$router = $this->app['router'];

        $router->before(BeforeGlobalFilter::class);
        $router->after(AfterGlobalFilter::class);

//also you can register your route level middlewares using the router
        $router->middleware('manager', MiddlewareRole::class);*/

        //$router = $this->app['router'];

        //$router->before(\BeforeGlobalFilter::class);
        //$router->after(\AfterGlobalFilter::class);

//also you can register your route level middlewares using the router
        //$router->middleware('Checku', \webvolant\abadmin\Http\Middleware\Checku::class);

        //$this->middleware('\webvolant\abadmin\Http\Middleware\Checku');



        //$this->app->make('webvolant\abadmin\LoginController');
        //$this->app->make('webvolant/abadmin');
        include __DIR__ . '/routes.php';
    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        //$this->registerConfig();
        //$this->loadViewsFrom(__DIR__.'/../views', 'abslider');

        //$this->registerConfig();
        //$this->mergeConfigFrom(
        //    __DIR__.'/../config/config.php', 'abadmin'
        //);

        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'config'
        );
/*
        $this->app->bind('path.public', function() {
            return base_path().'/public';
        });
*/
    }

}