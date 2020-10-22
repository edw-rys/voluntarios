<?php

namespace App\Http\Controllers\Api\Voluntarios;

use App\Http\Controllers\Controller;
use App\Repositories\CiudadRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\FactultadRepository;
use App\Repositories\GeneroRepository;
use App\Repositories\PaisRepository;
use App\Repositories\VoluntariosRepository;
use Illuminate\Http\Request;

class VoluntariosApiController extends Controller
{
    private $voluntariosRepository;
    private $estadoCivilRepository;
    private $generoRepository;
    private $paisRepository;
    private $ciudadRepository;
    /**
     * VoluntariosApiController constructor 
     */
    public function __construct(
        VoluntariosRepository $voluntariosRepository,
        EstadoCivilRepository $estadoCivilRepository,
        GeneroRepository $generoRepository,
        CiudadRepository $ciudadRepository,
        PaisRepository $paisRepository,
        FactultadRepository $factultadRepository
    ) {
        $this->voluntariosRepository = $voluntariosRepository;
        $this->estadoCivilRepository = $estadoCivilRepository;
        $this->generoRepository      = $generoRepository;
        $this->ciudadRepository      = $ciudadRepository;
        $this->paisRepository        = $paisRepository;
    }
    /**
     * @param $pasaporte
     */
    public function existPasaporte(Request $request)
    {
        $voluntario = $this->voluntariosRepository->where('status', 1)->where('Pasaporte' , $request->input('pasaporte', ''))->first();
        return response()->json([
            'exist' => $voluntario!=null
        ]);
    }

    /**
     * Ciudades
     */
    public function ciudades(Request $request)
    {
        return response()->json($this->ciudadRepository->where('status', 1)->where('pais', $request->input('pais'))->get(), 200);
    }
    /**
     * Ciudades
     */
    public function paises()
    {
        return response()->json($this->paisRepository->where('status', 1)->get(), 200);
    }
    /**
     * Ciudades
     */
    public function obtenerCiudades()
    {
        return response()->json($this->ciudadRepository->where('status', 1)->get(), 200);
    }
    /**
     * Facultad
     */
    public function obtenerFacultades()
    {
        return response()->json($this->factultadRepository->where('status', 1)->get(), 200);
    }
}
