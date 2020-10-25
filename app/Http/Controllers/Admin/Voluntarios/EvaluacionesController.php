<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\EvaluacionesDataTable;
use App\DataTables\FormFilters\FormFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voluntarios\Evaluacion\EvaluacionRequest;
use App\Repositories\EvaluacionesRepository;
use App\Repositories\VoluntariosRepository;
use App\Services\EvaluacionesService;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{
    /**
     * @vars
     */
    private $views;
    private $voluntariosRepository;
    private $evaluacionesRepository;
    private $evaluacionesService;
    private $options_dompdf;

    /**
     * VoluntariosController constructor.
     * @param EvaluacionesRepository $evaluacionesRepository
     * @param VoluntariosRepository $voluntariosRepository
     * @param EvaluacionesService $evaluacionesService
     */
    public function __construct(EvaluacionesRepository $evaluacionesRepository, VoluntariosRepository $voluntariosRepository, EvaluacionesService $evaluacionesService)
    {
        $this->evaluacionesRepository = $evaluacionesRepository;
        $this->voluntariosRepository  = $voluntariosRepository;
        $this->evaluacionesService    = $evaluacionesService;

        $this->views        = (object) [
            'index'         => 'admin.pages.evaluaciones.index',
            'evaluate'      => 'admin.pages.evaluaciones.evaluate',
            'evluacion_periodo'  => 'admin.pages.evaluaciones.evluacion_periodo'
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
        $this->options_dompdf = [
            'dpi'                       => 180,
            'defaultFont'               => 'helvetica',
            'defaultPaperSize'          => 'A4',
            'defaultMediaType'          => 'print',
            'defaultPaperOrientation'   => 'portrait',
            'isHtml5ParserEnabled'      => true,
            'isPhpEnabled'              => true,
            'isRemoteEnabled'           => true,
            'enable_remote'             => true
        ];

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(EvaluacionesDataTable $dataTable)
    {
        viewExist($this->views->index);

        $dataTable->filters = $this->filters;

        return $dataTable->render($this->views->index, [
            'filters'   => (new FormFilter())->filters($this->filters, $this->voluntariosRepository),
        ]);
    }
    /**
     * Evaluate
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function evaluateView($id)
    {
        viewExist($this->views->evaluate);

        $item = $this->voluntariosRepository
            ->findDecoded($id, ['*'], ['universidad'], true);
        
        return $this->evaluacionesService->ajax($item, $this->views->evaluate, $this->routes->index);
    }

     /**
     * Evaluate
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function evaluate(EvaluacionRequest $request,$id)
    {
        return $this->evaluacionesService->store($request, $this->routes);
    }
    
    /**
     * Evaluate
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function reporteView($id)
    {
        viewExist($this->views->evluacion_periodo);

        $voluntario = $this->voluntariosRepository
            ->find($id, ['*'], ['universidad'], true);
            
        $item = $this->evaluacionesRepository
            ->where('CodigoReferencia', $voluntario->id)
            ->with('periodo')
            ->with('voluntario')
            ->get();
        // dd($item);
        return $this->evaluacionesService->ajax($item, $this->views->evluacion_periodo, $this->routes->index);
    }
}
