<?php

use App\Repositories\CiudadRepository;
use App\Repositories\EstadoCivilRepository;
use App\Repositories\FactultadRepository;
use App\Repositories\PaisRepository;
use App\Repositories\TipoPracticaRepository;
use App\Repositories\UnidadRepository;
use App\Repositories\UniversidadRepository;

if (! function_exists('tipo_practica_min')) {
    /**
     *
     * @param $tipo_practica_id
     * @return string
     */
    function tipo_practica_min($tipo_practica_id)
    {
        $tipo =(new TipoPracticaRepository)->where('codigo', $tipo_practica_id)->first();
        if($tipo === null){
            return '';
        }
        switch ($tipo->descripcion){
            case 'PRE-PROFESIONAL': 
                return 'practicante';
            case 'VOLUNTARIADO': 
                return 'voluntario';
        }
        return '';
    }
}

if (! function_exists('tipo_practica_ext_long')) {
    /**
     *
     * @param $tipo_practica_id
     * @return string
     */
    function tipo_practica_ext_long($tipo_practica_id)
    {
        $tipo =(new TipoPracticaRepository)->where('codigo', $tipo_practica_id)->first();
        if($tipo === null){
            return '';
        }
        switch ($tipo->descripcion){
            case 'PRE-PROFESIONAL': 
                return 'sus prácticas pre profesionales';
            case 'VOLUNTARIADO': 
                return 'valuntariado';
        }
        return '';
    }
}


if (! function_exists('tipo_practica_ext')) {
    /**
     *
     * @param $tipo_practica_id
     * @return string
     */
    function tipo_practica_ext($tipo_practica_id)
    {
        $tipo =(new TipoPracticaRepository)->where('codigo',$tipo_practica_id)->first();
        if($tipo === null){
            return '';
        }
        switch ($tipo->descripcion){
            case 'PRE-PROFESIONAL': 
                return 'prácticas';
            case 'VOLUNTARIADO': 
                return 'valuntariado';
        }
        return '';
    }
}


if (! function_exists('tipo_practica_ext_vigencia')) {
    /**
     *
     * @param $tipo_practica_id
     * @return string
     */
    function tipo_practica_ext_vigencia($tipo_practica_id)
    {
        $tipo =(new TipoPracticaRepository)->where('codigo',$tipo_practica_id)->first();
        if($tipo === null){
            return '';
        }
        switch ($tipo->descripcion){
            case 'PRE-PROFESIONAL': 
                return 'de las prácticas';
            case 'VOLUNTARIADO': 
                return 'del voluntariado';
        }
        return '';
    }
}

// Universidad Guayaquil


if (! function_exists('obtener_universiad')) {
    /**
     *
     * @param $universidad_id
     * @return string
     */
    function obtener_universiad($universidad_id)
    {
        $universidad =(new UniversidadRepository)->find($universidad_id);
        if($universidad === null){
            return '';
        }
        return $universidad->Nombre;
    }
}


if (! function_exists('obtener_unidad')) {
    /**
     *
     * @param $universidad_id
     * @return string
     */
    function obtener_unidad($unidad_id)
    {
        $unidad =(new UnidadRepository)->find($unidad_id);
        if($unidad === null){
            return '';
        }
        return $unidad->Nombre;
    }
}

if (! function_exists('abortNotChangePeriod')) {
    /**
     *
     * @param $universidad_id
     * @return string
     */
    function abortNotChangePeriod($voluntario)
    {
        if($voluntario->periodos->first() === null){
            if($voluntario->evaluacion !== null){
                return ;
            }
            abort(403);
        }
        // SI tiene un periodo activo y no tiene evaluación, se presenta el modal
        if($voluntario->periodos->last()->evaluacion()->first() !== null){
            return;
        }
        abort(403);
    }
}

if (! function_exists('_estadoCivil')) {
    /**
     *
     * @param $estado_civil_id
     * @return string
     */
    function _estadoCivil($estado_civil_id)
    {
        $item = (new EstadoCivilRepository)->find($estado_civil_id);
        if($item === null ){
            return 'No definido';
        }
        return $item->Nombre;
    }
}

if (! function_exists('_pais')) {
    /**
     *
     * @param $pais_id
     * @return string
     */
    function _pais($pais_id)
    {
        $item = (new PaisRepository)->find($pais_id);
        if($item === null ){
            return 'No definido';
        }
        return $item->Nombre;
    }
}

if (! function_exists('_ciudad')) {
    /**
     *
     * @param $ciudad_id
     * @return string
     */
    function _ciudad($ciudad_id)
    {
        $item = (new CiudadRepository)->find($ciudad_id);
        if($item === null ){
            return 'No definido';
        }
        return $item->Nombre;
    }
}

if (! function_exists('_facultad')) {
    /**
     *
     * @param $facultad_id
     * @return string
     */
    function _facultad($universidad_id, $facultad_id)
    {
        $item = (new FactultadRepository)->where('idFacultad', $facultad_id)->where('idUniversidad', $universidad_id)->first();
        if($item === null ){
            return 'No definido';
        }
        return $item->NombreFacultad;
    }
}