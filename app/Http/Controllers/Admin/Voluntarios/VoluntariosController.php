<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\FormFilters\FormFilter;
use App\DataTables\VoluntariosDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\AlimentacionRepository;
use App\Repositories\DepartamentoRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\GeneroRepository;
use App\Repositories\HorasDiasRepository;
use App\Repositories\PaisRepository;
use App\Repositories\PasatiempoRepository;
use App\Repositories\TipoPracticaRepository;
use App\Repositories\UnidadRepository;
use App\Repositories\UniversidadRepository;
use App\Repositories\VoluntariosRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class VoluntariosController extends Controller
{
    /**
     * @vars
     */
    private $voluntariosService;
    private $tipoPracticaRepository;
    private $alimentacionRepository;
    private $departamentoRepository;
    private $estadoCivilRepository;
    private $voluntariosRepository;
    private $universidadRepository;
    private $pasatiempoRepository;
    private $horasDiasRepository;
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
        VoluntariosRepository $voluntariosRepository, 
        TipoPracticaRepository $tipoPracticaRepository,
        PaisRepository $paisRepository,
        GeneroRepository $generoRepository,
        EstadoCivilRepository $estadoCivilRepository,
        PasatiempoRepository $pasatiempoRepository,
        UniversidadRepository $universidadRepository,
        UnidadRepository $unidadRepository,
        DepartamentoRepository $departamentoRepository,
        AlimentacionRepository $alimentacionRepository,
        HorasDiasRepository $horasDiasRepository
    )
    {
        $this->horasDiasRepository    = $horasDiasRepository;
        $this->alimentacionRepository = $alimentacionRepository;
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
            'index'   => 'admin.pages.voluntarios.index',
            'create'  => 'admin.pages.voluntarios.create',
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
        // dd($this->horasDiasRepository->actives());
        // dd($this->departamentoRepository->activosPorPermiso($this->permisos->departamentos_todos)->get());
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
}
