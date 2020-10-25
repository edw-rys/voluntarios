<?php
if (! function_exists('evaluate_show')) {
    /**
     * Create show action
     *
     * @param string $route
     * @param int $id
     * @param string|array|Translator $name
     * @return string
     */
    function evaluate_show(string $route, int $id, string $name = ''): string
    {
        if (! route_exists($route)) {
            return '';
        }

        if ($name === '') {
            $name = trans('global.view');
        }

        return '<a href="' . route($route, $id) . '" class="btn btn-warning" data-show="true"><i class="far fa-clipboard"></i> ' . $name . '</a>';
    }
}
if (! function_exists('show_modal')) {
    /**
     * Create show action
     *
     * @param string $route
     * @param int $id
     * @param string|array|Translator $name
     * @return string
     */
    function show_modal(string $route, int $id, string $name = ''): string
    {
        if (! route_exists($route)) {
            return '';
        }

        if ($name === '') {
            $name = trans('global.view');
        }

        return '<a href="' . route($route, $id) . '" class="btn btn-warning" data-show="true"><i class="far fa-clipboard"></i> ' . $name . '</a>';
    }
}