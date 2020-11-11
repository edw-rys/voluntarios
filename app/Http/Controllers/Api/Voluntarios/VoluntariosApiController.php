<?php

namespace App\Http\Controllers\Api\Voluntarios;

use App\Http\Controllers\Controller;
use App\Repositories\CiudadRepository;
use App\Repositories\DepartamentoRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\FactultadRepository;
use App\Repositories\GeneroRepository;
use App\Repositories\PaisRepository;
use App\Repositories\UserRepository;
use App\Repositories\VoluntariosRepository;
use Illuminate\Http\Request;

class VoluntariosApiController extends Controller
{
    private $voluntariosRepository;
    private $estadoCivilRepository;
    private $departamentoRepository;
    private $ciudadRepository;
    private $generoRepository;
    private $paisRepository;
    private $userRepository;
    private $factultadRepository;
    private $permisos ;
    /**
     * VoluntariosApiController constructor 
     */
    public function __construct(
        VoluntariosRepository $voluntariosRepository,
        EstadoCivilRepository $estadoCivilRepository,
        GeneroRepository $generoRepository,
        CiudadRepository $ciudadRepository,
        PaisRepository $paisRepository,
        UserRepository $userRepository,
        FactultadRepository $factultadRepository,
        DepartamentoRepository $departamentoRepository
    ) {
        $this->userRepository        = $userRepository;
        $this->factultadRepository   = $factultadRepository;
        $this->voluntariosRepository = $voluntariosRepository;
        $this->departamentoRepository = $departamentoRepository;
        $this->estadoCivilRepository = $estadoCivilRepository;
        $this->generoRepository      = $generoRepository;
        $this->ciudadRepository      = $ciudadRepository;
        $this->paisRepository        = $paisRepository;

        $this->permisos = (object) [
            'departamentos_todos'    => 'all_departments',
            'tutores_todos'          => 'all_tutor_bspi'
        ];
    }
    /**
     * Veriticar si el pasaporte ya está registrado en la DB, retorna respuesta en formato json
     * @param $request
     */
    public function existPasaporte(Request $request)
    {
        $voluntario = $this->voluntariosRepository->where('status', 1)->where('Pasaporte' , $request->input('pasaporte', ''))->first();
        return response()->json([
            'exist' => $voluntario!=null
        ]);
    }

    /**
     * Obtener Ciudades en formato json
     * @param Request $request 
     */
    public function ciudades(Request $request)
    {
        return response()->json($this->ciudadRepository->where('status', 1)->where('pais', $request->input('pais'))->get(), 200);
    }
    /**
     * ObtenerCiudades en formato json
     * @param Request $request 
     */
    public function paises()
    {
        return response()->json($this->paisRepository->where('status', 1)->get(), 200);
    }
    /**
     * Obtener Ciudades en formato json
     * @param Request $request 
     */
    public function obtenerCiudades(Request $request)
    {
        if($request->input('pais', null) == null){
            return response()->json($this->ciudadRepository->where('status', 1)->get(), 200);
        }
        return response()->json($this->ciudadRepository->where('Pais', $request->input('pais'))->where('status', 1)->get(), 200);
    }
    /**
     * Obtener Facultad en formato json
     * @param Request $request 
     */
    public function obtenerFacultades(Request $request)
    {
        if($request->input('universidad', null) == null){
            return response()->json($this->factultadRepository->where('status', 1)->get(), 200);
        }
        return response()->json($this->factultadRepository->where('idUniversidad', $request->input('universidad'))->get(), 200);
    }
    /**
     * Obtener Departamentos en formato json
     * @param Request $request 
     */
    public function obtenerDepartamentos(Request $request)
    {
        // $user = $this->userRepository->where('status', 1);
        $departamentos = $this->departamentoRepository;
        if(!allows_permission($this->permisos->departamentos_todos)){
            $departamentos = $departamentos->where('id', auth()->user()->departamento);
        }
        return response()->json($departamentos->get(), 200);
    }
    /**
     * Obtener Tutor en formato json
     * @param Request $request 
     */
    public function obtenerTutores(Request $request)
    {
        $tutores = $this->userRepository->where('status', 1);

        if(allows_permission($this->permisos->tutores_todos)){
            if($request->input('departamento', null) !== null){
                $tutores = $tutores->where('departamento', $request->input('departamento'));
            }
        }else{
            $tutores = $tutores->where('id', auth()->user()->id);
        }
        return response()->json($tutores->get(), 200);
    }
}
