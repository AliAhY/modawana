<?php

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This is the path to the "home" route for your application.
     *
     * @var string */
    protected $home = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void */
    public function boot()
    {
        //
    }

    /**
     * Define the routes for the application.
     *
     * @return void */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless and are assigned the "api" middleware group.
     *
     * @return void */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace . '\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes are typically stateful and are assigned the "web" middleware group.
     *
     * @return void */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
