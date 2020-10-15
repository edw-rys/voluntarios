<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * @vars
     */
    private $views;

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->views        = (object) [
            'index'   => 'admin.pages.dashboard.index',
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        viewExist($this->views->index);
        return view($this->views->index);
    }
}
