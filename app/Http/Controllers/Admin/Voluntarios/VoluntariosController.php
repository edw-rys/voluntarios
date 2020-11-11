<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\FormFilters\FormFilter;
use App\DataTables\VoluntariosDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voluntarios\Perfil\CambioPeriodoRequest;
use App\Http\Requests\Admin\Voluntarios\Perfil\StoreVoluntarioRequest;
use App\Http\Requests\Admin\Voluntarios\Perfil\UpdateVoluntarioRequest;
use App\Repositories\AlimentacionRepository;
use App\Repositories\DepartamentoRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\EvaluacionesRepository;
use App\Repositories\GeneroRepository;
use App\Repositories\HorasDiasRepository;
use App\Repositories\PaisRepository;
use App\Repositories\PasatiempoRepository;
use App\Repositories\PeriodoVoluntarioRepository;
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
    private $periodoVoluntarioRepository;
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
        PaisRepository         $paisRepository,
        PeriodoVoluntarioRepository $periodoVoluntarioRepository
    )
    {
        $this->periodoVoluntarioRepository     = $periodoVoluntarioRepository;
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
            'edit'          => 'admin.pages.voluntarios.edit',
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
            'departamentos_todos'   => 'all_departments',
            'tutores_todos'         => 'all_totor_bspi',
            'acceso_certificados'   => 'acceso_certificados',
            'acceso_voluntarios'    => 'acceso_voluntarios',
            'crear_voluntarios'     => 'crear_voluntarios',
            'editar_voluntarios'    => 'editar_voluntarios',
            'cambio_periodo'        => 'cambio_periodo',
            'mostrar_voluntarios'   => 'mostrar_voluntarios',
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(VoluntariosDataTable $dataTable)
    {
        _canAccess_($this->permisos->acceso_voluntarios);

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
        _canAccess_($this->permisos->crear_voluntarios);

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
    /**
     * Guardar los datos
     * @param StoreVoluntarioRequest $request
     */
    public function store(StoreVoluntarioRequest $request)
    {
        _canAccess_($this->permisos->crear_voluntarios);

        return $this->voluntariosService->store($request, $this->routes);
    }
    /**
     * Se presenta la vista de certificados por medio de ajax (se presentará en un modal)
     * @param $id
     */
    public function certificadosView($id)
    {
        // Denegar vista en caso de no tener permisos
        _canAccess_($this->permisos->acceso_certificados);

        viewExist($this->views->certificados);

        $voluntario = $this->voluntariosRepository
            ->find($id, ['*'], ['universidad'], true);
        
        if($voluntario === null){
            abort(404);
        }
    
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
        _canAccess_($this->permisos->cambio_periodo);

        // Validar si tiene un periodo activo
        $voluntario = $this->voluntariosRepository->findDecoded($id, ['*'], ['periodos']);
        
        viewExist($this->views->change_period);
        if($voluntario === null){
            abort(404);
        }

        abortNotChangePeriod($voluntario);

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
        _canAccess_($this->permisos->cambio_periodo);
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

        _canAccess_($this->permisos->mostrar_voluntarios);

        viewExist($this->views->show);

        $item = $this->voluntariosRepository->
            findDecoded($id, ['*'], ['genero_detalle', 'pais_detalle', 'ciudad_detalle','periodos'], true);
        // dd($item);
        return $this->voluntariosService->ajax($item, $this->views->show, $this->routes->index);
    }

    /**
     *  Se presenta la vista para editar y se envían los datos
     * @param $id
     */
    public function edit($id)
    {
        _canAccess_($this->permisos->editar_voluntarios);
        // Find user
        $voluntario = $this->voluntariosRepository->findDecoded($id);
        if($voluntario === null){
            abort(404);
        }
        // Buscar periodo
        $periodo = $this->periodoVoluntarioRepository
            ->where('voluntario_id', $voluntario->id)
            ->with('horario_semana')
            ->get()
            ->last();
        // dd($periodo->horario_semana);
        if($periodo === null){
            $periodo = (object) [
                'id'                    => 0,
                'universidad_id'        => $voluntario->Universidad,
                'facultad_id'           => $voluntario->Facultad,
                'carrera'               => $voluntario->Carrera,
                'nivel'                 => $voluntario->Nivel,
                'tutor'                 => $voluntario->Tutor,
                'unidad_id'             => $voluntario->Unidad,
                'departamento_id'       => $voluntario->Departamento,
                'proyecto'              => $voluntario->Proyecto,
                'tutor_bspi_id'         => $voluntario->idtutor,
                // 'tutor_bspi_id'         => $voluntario->TutorBspi,
                'fecha_inicio'          => $voluntario->FechaInicio,
                'fecha_fin'             => $voluntario->FechaFin,
                'FechaFinCertificado'   => $voluntario->FechaFin,
                'horas_programada'      => $voluntario->HorasProgramada,
                'alimentacion_id'       => $voluntario->Alimentacion,
                'tutor_bspi_nombre'     => $voluntario->Tutor,
                'horario_voluntario_id' => $voluntario->Horario,
                'horario'               => $voluntario->Horario,
                'chkActa'               => $voluntario->chkActa, 
                'tipo_practica_id'      => $voluntario->tipoPractica,
                'observacion'           => $voluntario->observacion ,
                'horario_semana'        => (object) [
                    'id'              => 0,
                    'lunes_data'      => '[]',
                    'martes_data'     => '[]',
                    'miercoles_data'  => '[]',
                    'viernes_data'    => '[]',
                    'jueves_data'     => '[]',
                    'sabado_data'     => '[]',
                    'domingo_data'    => '[]',
                ]       
            ];
        }
        viewExist($this->views->create);
        
        return view($this->views->edit)->with([
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
            'voluntario'     => $voluntario,
            'periodo'        => $periodo
        ]);
    }

    public function update(UpdateVoluntarioRequest $request)
    {
        _canAccess_($this->permisos->editar_voluntarios);

        return $this->voluntariosService->update($request, $this->routes);
    }
}
