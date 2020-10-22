<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The domain name for your application
     *
     * @var string
     */
    private $domain;

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // $this->configureRateLimiting();
        $this->map();
        
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->domain = config('app.url', env('APP_URL'));
        // dd($this->domain);
        $this->routes(function () {

            $this->mapWebRoutes();
            $this->mapAdminRoutes();
            $this->mapApiRoutes();
        });
        // $this->mapClientRoutes();
        // $this->mapAuthRoutes();
        // $this->mapAdminRoutes();
    }


    
    /**
     * Define the "api" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->domain($this->domain)
            ->namespace($this->namespace.'\Api')
            ->name('api.')
            ->group(base_path('routes/api.php'));
    }

      /**
     * Define the "client" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes(): void
    {
        Route::middleware(['web'])
            ->prefix('admin')
            ->domain($this->domain)
            ->namespace($this->namespace)
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
    }


    

     /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->domain($this->domain)
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
