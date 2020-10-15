<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composers([
            /**
             * DASHBOARD
             */
            \App\Http\ViewComposers\Client\DashboardComposer::class       => ['admin.templates.*'],
            \App\Http\ViewComposers\Client\TitleComposer::class           => ['admin.templates.*'],
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
