<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VoluntariosDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\UpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class VoluntariosController extends Controller
{
    /**
     * @vars
     */
    private $views;
    private $voluntariosService;

    /**
     * VoluntariosController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService  = $userService;
        $this->views        = (object) [
            'index'   => 'admin.pages.voluntarios.index',
        ];
        $this->routes       = (object) [
            'index'             => 'admin.voluntarios'
        ];

        $this->filters      = [
            //'status',
            // 'user_id',
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(VoluntariosDataTable $dataTable)
    {
        notifyMe('warning', trans('global.toasts.no_data'));
        viewExist($this->views->index);

        $dataTable->filters = $this->filters;
        // dd($dataTable->generateScripts());
        // return view($this->views->index);
        return $dataTable->render($this->views->index, [
            // 'filters'   => (new FormFilter())->filters($this->filters, $this->invoiceRepository),
        ]);
    }

}
