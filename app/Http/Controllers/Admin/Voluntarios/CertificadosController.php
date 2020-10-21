<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\CertificadosDataTable;
use App\DataTables\FormFilters\FormFilter;
use App\Http\Controllers\Controller;
use App\Repositories\VoluntariosCertificadosRepository;
use App\Repositories\VoluntariosRepository;
use Illuminate\Http\Request;

class CertificadosController extends Controller
{
    /**
     * @vars
     */
    private $views;
    private $voluntariosRepository;

    /**
     * VoluntariosController constructor.
     * @param EvaluacionesRepository $evaluacionesRepository
     */
    public function __construct( VoluntariosCertificadosRepository $voluntariosRepository)
    {
        $this->voluntariosRepository  = $voluntariosRepository;

        $this->views        = (object) [
            'index'    => 'admin.pages.evaluaciones.index',
            'evaluate' => 'admin.pages.evaluaciones.evaluate'
        ];
        $this->routes       = (object) [
            'index'         => 'admin.evaluaciones.index',
            'evaluate'      => 'admin.evaluaciones.evaluate'
        ];

        $this->filters      = [
            'status',
            'departemento',
            'user_id',
        ];
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(CertificadosDataTable $dataTable)
    {
        // notifyMe('warning', trans('global.toasts.no_data'));
        viewExist($this->views->index);

        $dataTable->filters = $this->filters;

        return $dataTable->render($this->views->index, [
            'filters'   => (new FormFilter())->filters($this->filters, $this->voluntariosRepository),
        ]);
    }
    
}
