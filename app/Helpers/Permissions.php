<?php

use App\Repositories\OpcionAplicacionPerfilRepository;

if (! function_exists('allows_permission')) {
    /**
     * Tiene el rol indicado
     *
     * @param string $name
     * @return bool
     */
    function allows_permission(string $permission_name): bool
    {
        return (new OpcionAplicacionPerfilRepository)
            ->join('SG_OPCION_APLICACION', 'SG_OPCION_APLICACION.codigo', 'SG_OPCION_APLICACION_POR_PERFIL.opcion_aplicacion')
            ->where('SG_OPCION_APLICACION.ejecutable' , $permission_name)
            ->where('perfil', auth()->user()->id)
            ->first() !== null;
    }
}