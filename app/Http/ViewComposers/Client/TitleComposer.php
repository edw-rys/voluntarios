<?php

namespace App\Http\ViewComposers\Client;

use App\Repositories\MenuRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class TitleComposer
{
    /**
     * Bind Admin Menu data to the view.
     *
     * @param View $view
     */
    public function compose(View $view): void
    {
        $viewComposerName   = 'titleContent';

        $currentRouteName   = Route::currentRouteName();
        $routeExplode       = explode('.', $currentRouteName);

        // Only in admin, has in cache?
        if ($routeExplode[0] === 'admin' && $routeExplode[1] !== '' & ! Cache::has($currentRouteName)) {
            $adminTitle = (object)[
                'title'         => trans('global.titles.'. $routeExplode[1]),
                'description'   => '',
                'icon'          => '',
            ];
        } else {
            $adminTitle = Cache::get($currentRouteName);
        }
        $html = (object)[
            'title'         => $adminTitle->title ?? '',
            'description'   => $adminTitle->description ?? '',
            'icon'          => $adminTitle->icon ?? '',
        ];


        $view->with($viewComposerName, $html);
    }
}
