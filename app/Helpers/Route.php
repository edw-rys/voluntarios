<?php

use Illuminate\Contracts\Routing\UrlGenerator;

if (! function_exists('route_is')) {
    /**
     * Route is (true|false)
     *
     * @param $route
     * @return bool
     */
    function route_is($route = '')
    {
        return Route::currentRouteName() === $route;
    }
}

if (! function_exists('route_exists')) {
    /**
     * Route exists (true|false)
     *
     * @param $route
     * @return bool
     */
    function route_exists($route): bool
    {
        return Route::has($route);
    }
}

if (! function_exists('route_has')) {
    /**
     * Route exists
     *
     * @param $route
     * @return string
     */
    function route_has($route)
    {
        if (! Route::has($route)) {
            return '#';
        }

        return $route;
    }
}

if (! function_exists('checkRoute')) {
    /**
     * Check route
     *
     * @param $route
     * @return bool
     */
    function checkRoute($route)
    {
        if ($route[0] === '/') {
            $route = substr($route, 1);
        }

        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $r) {
            /** @var \Route $r */
            if ($r->uri === $route) {
                return true;
            }

            if (isset($r->action['as']) && $r->action['as'] === $route) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('url_link')) {
    /**
     * @param $path
     * @return UrlGenerator|string
     */
    function url_link($path = '')
    {
        $prefix = config('app_invoice.prefix_page');

        if ($path === '') {
            return url($prefix) . '/';
        }

        return url($prefix . '/' . $path);
    }
}
