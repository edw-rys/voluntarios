<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class DashboardComposer
{
    /**
     * DashboardComposer constructor
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $route_name = Route::getCurrentRoute()->getName();
        $view
            ->with('user', auth()->user())
            ->with('route_name', $route_name);
    }
}