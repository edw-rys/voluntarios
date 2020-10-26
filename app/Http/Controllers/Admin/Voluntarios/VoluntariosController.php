<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\FormFilters\FormFilter;
use App\DataTables\VoluntariosDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voluntarios\Perfil\CambioPeriodoRequest;
use App\Http\Requests\Admin\Voluntarios\Perfil\StoreVoluntarioRequest;
use App\Repositories\AlimentacionRepository;
use App\Repositories\DepartamentoRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\EvaluacionesRepository;
use App\Repositories\GeneroRepository;
use App\Repositories\HorasDiasRepository;
use App\Repositories\PaisRepository;
use App\Repositories\PasatiempoRepository;
use App\Repositories\TipoPracticaRepository;
use App\Repositories\UnidadRepository;
use App\Repositories\UniversidadRepository;
use App\Repositories\VoluntariosRepository;
use App\Services\UserService;
use App\Services\VoluntariosService;
use Illuminate\Http\Request;

class VoluntariosController extends Controller
{
    /**
     * @vars
     */
    private $tipoPracticaRepository;
    private $alimentacionRepository;
    private $departamentoRepository;
    private $evaluacionesRepository;
    private $estadoCivilRepository;
    private $voluntariosRepository;
    private $universidadRepository;
    private $pasatiempoRepository;
    private $horasDiasRepository;
    private $voluntariosService;
    private $generoRepository;
    private $unidadRepository;
    private $paisRepository;
    private $permisos;
    private $views;

    /**
     * VoluntariosController constructor.
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService, 
        AlimentacionRepository $alimentacionRepository,
        TipoPracticaRepository $tipoPracticaRepository,
        DepartamentoRepository $departamentoRepository,
        EstadoCivilRepository  $estadoCivilRepository,
        EvaluacionesRepository $evaluacionesRepository,
        VoluntariosRepository  $voluntariosRepository, 
        UniversidadRepository  $universidadRepository,
        PasatiempoRepository   $pasatiempoRepository,
        HorasDiasRepository    $horasDiasRepository,
        VoluntariosService     $voluntariosService,
        UnidadRepository       $unidadRepository,
        GeneroRepository       $generoRepository,
        PaisRepository         $paisRepository
    )
    {
        $this->voluntariosService     = $voluntariosService;
        $this->horasDiasRepository    = $horasDiasRepository;
        $this->alimentacionRepository = $alimentacionRepository;
        $this->evaluacionesRepository = $evaluacionesRepository;
        $this->departamentoRepository = $departamentoRepository;
        $this->userService            = $userService;
        $this->unidadRepository       = $unidadRepository;
        $this->pasatiempoRepository   = $pasatiempoRepository;
        $this->tipoPracticaRepository = $tipoPracticaRepository;
        $this->voluntariosRepository  = $voluntariosRepository;
        $this->estadoCivilRepository  = $estadoCivilRepository;
        $this->generoRepository       = $generoRepository;
        $this->paisRepository         = $paisRepository;
        $this->universidadRepository  = $universidadRepository;
        $this->views        = (object) [
            'index'         => 'admin.pages.voluntarios.index',
            'create'        => 'admin.pages.voluntarios.create',
            'certificados'  => 'admin.pages.voluntarios.certificado_periodo',
            'change_period' => 'admin.pages.voluntarios.change_period',
            'show'          => 'admin.pages.voluntarios.show',
        ];
        $this->routes       = (object) [
            'index'   => 'admin.voluntarios.index'
        ];

        $this->filters      = [
            'status',
            'departamento',
            'tipo_practica'
        ];

        $this->permisos = (object) [
            'departamentos_todos'    => 'Todos los departamentos',
            'tutores_todos'          => 'Todos los tutores'
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
    /**
     * Create new item
     *
     * @return Factory|View
     */
    public function create()
    {
        viewExist($this->views->create);
        return view($this->views->create)->with([
            'cancel'         => route($this->routes->index),
            'tiposPractica'  => $this->tipoPracticaRepository->where('status', 1)->get(),
            'paises'         => $this->paisRepository->where('status', 1)->get(),
            'generos'        => $this->generoRepository->where('status', 1)->get(),
            'horas'          => $this->horasDiasRepository->actives(),
            'pasatiempos'    => $this->pasatiempoRepository->where('status', 1)->get(),
            'estadosciviles' => $this->estadoCivilRepository->where('status', 1)->get(),
            'universidades'  => $this->universidadRepository->where('status', 1)->get(),
            'unidades_bspi'  => $this->unidadRepository->actives(),
            'alimentaciones' => $this->alimentacionRepository->actives(),
            'departamentos'  => $this->departamentoRepository->activosPorPermiso($this->permisos->departamentos_todos)->get(),
        ]);
    }

    public function store(StoreVoluntarioRequest $request)
    {

        return $this->voluntariosService->store($request, $this->routes);
    }

    public function certificadosView($id)
    {
        viewExist($this->views->certificados);

        $voluntario = $this->voluntariosRepository
            ->find($id, ['*'], ['universidad'], true);
        
        $item = $this->evaluacionesRepository
            ->where('CodigoReferencia', $voluntario->id)
            ->with('periodo')
            ->with('voluntario')
            ->get();
        // dd($item);
        return $this->voluntariosService->ajax($item, $this->views->certificados, $this->routes->index);
    }


    /**
     * cambiarPeriodo
     *
     * @return Factory|View
     */
    public function cambiarPeriodo($id)
    {
        // Validr si tiene un periodo activo
        $voluntario = $this->voluntariosRepository->findDecoded($id);
        
        viewExist($this->views->change_period);
        if($voluntario === null){
            abort(404);
        }
        return view($this->views->change_period)->with([
            'cancel'         => route($this->routes->index),
            'voluntario'     => $voluntario,
            'tiposPractica'  => $this->tipoPracticaRepository->where('status', 1)->get(),
            // 'paises'         => $this->paisRepository->where('status', 1)->get(),
            // 'generos'        => $this->generoRepository->where('status', 1)->get(),
            'horas'          => $this->horasDiasRepository->actives(),
            'pasatiempos'    => $this->pasatiempoRepository->where('status', 1)->get(),
            // 'estadosciviles' => $this->estadoCivilRepository->where('status', 1)->get(),
            'universidades'  => $this->universidadRepository->where('status', 1)->get(),
            'unidades_bspi'  => $this->unidadRepository->actives(),
            'alimentaciones' => $this->alimentacionRepository->actives(),
            'departamentos'  => $this->departamentoRepository->activosPorPermiso($this->permisos->departamentos_todos)->get(),
        ]);
    }

    public function cambiarPeriodoStore(CambioPeriodoRequest $request)
    {
        // Validr si tiene un periodo activo
        return $this->voluntariosService->cambioPeriodo($request, $this->routes);
    }

    /**
     * Show an item
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function show($id)
    {

        // viewExist($this->views->show);

        $item = $this->voluntariosRepository->
            findDecoded($id, ['*'], ['genero_detalle', 'pais_detalle', 'ciudad_detalle','periodos'], true);
        // dd($item);
        return $this->voluntariosService->ajax($item, $this->views->show, $this->routes->index);
    }
}
