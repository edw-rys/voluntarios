<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\FormFilters\FormFilter;
use App\DataTables\VoluntariosDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\UpdateRequest;
use App\Http\Requests\RequestTest;
use App\Repositories\VoluntariosRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class VoluntariosController extends Controller
{
    /**
     * @vars
     */
    private $views;
    private $voluntariosService;
    private $voluntariosRepository;

    /**
     * VoluntariosController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService, VoluntariosRepository $voluntariosRepository)
    {
        $this->userService  = $userService;
        $this->voluntariosRepository  = $voluntariosRepository;
        $this->views        = (object) [
            'index'   => 'admin.pages.voluntarios.index',
        ];
        $this->routes       = (object) [
            'index'             => 'admin.voluntarios'
        ];

        $this->filters      = [
            'status',
            // 'user_id',
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(VoluntariosDataTable $dataTable)
    {
        // notifyMe('warning', trans('global.toasts.no_data'));
        viewExist($this->views->index);

        $dataTable->filters = $this->filters;

        return $dataTable->render($this->views->index, [
            'filters'   => (new FormFilter())->filters($this->filters, $this->voluntariosRepository),
        ]);
    }
    public function f(RequestTest $request)
    {
        return 'bien';
    }

}
