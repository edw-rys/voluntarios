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
        // return true;

        if(config('app_voluntarios.permission')){
            return (new OpcionAplicacionPerfilRepository)
                ->join('SG_OPCION_APLICACION', 'SG_OPCION_APLICACION.codigo', 'SG_OPCION_APLICACION_POR_PERFIL.opcion_aplicacion')
                ->where('SG_OPCION_APLICACION.ejecutable' , $permission_name)
                ->where('perfil', auth()->user()->nivel)
                ->first() !== null;
        }
        return true;
    }
}

if (! function_exists('_canAccess_')) {
    /**
     * Tiene el rol indicado
     *
     * @param string $permission_name
     * @return void
     */
    function _canAccess_(string $permission_name): void
    {
       if(!allows_permission($permission_name)){
           abort(403);
       }
    }
}
