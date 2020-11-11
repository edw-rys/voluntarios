<?php

use App\Repositories\DepartamentoRepository;
use App\Repositories\FactultadRepository;
use App\Repositories\UnidadRepository;
use App\Repositories\UniversidadRepository;
use App\Repositories\VoluntariosRepository;
use Illuminate\Support\Facades\DB;

if (! function_exists('datosVoluntariosUniversidad')) {
    /**
     * Obtener datosVoluntariosUniversidad 
     *
     * @return mixed
     */
    function datosVoluntariosUniversidad($status=1)
    {
        $universidades = (new UniversidadRepository)->where('status', 1)->get();
        foreach ($universidades as $key => $universidad) {
            $universidad->voluntarios = (new VoluntariosRepository)->where('Universidad', $universidad->id)->where('status', $status)->count();
        }

        return $universidades;
    }
}


if (! function_exists('datosVoluntariosFacultades')) {
    /**
     * Obtener datosVoluntariosFacultades  
     *
     * @return mixed
     */
    function datosVoluntariosFacultades($status=1)
    {
        $facultades = (new FactultadRepository)->where('status', 1)->get();
        foreach ($facultades as $key => $facultad) {
            $facultad->voluntarios = (new VoluntariosRepository)->where('Universidad', $facultad->id)->where('status', $status)->count();
        }
        return $facultades;
    }
}

if (! function_exists('datosVoluntariosDepartamentos')) {
    /**
     * Obtener datosVoluntariosDepartamentos  
     *
     * @return mixed
     */
    function datosVoluntariosDepartamentos($status=1)
    {
        $departamentos = (new DepartamentoRepository)->where('status', 1)->get();
        foreach ($departamentos as $key => $departamento) {
            $departamento->voluntarios = (new VoluntariosRepository)->where('Universidad', $departamento->id)->where('status', $status)->count();
        }
        return $departamentos;
    }
}