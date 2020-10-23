<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionAplicacionPerfil extends Model
{
    use HasFactory;
    protected $table = 'SG_OPCION_APLICACION_POR_PERFIL'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa',
        'sucursal',
        'modulo',
        'perfil',
        'opcion_aplicacion',
        'superior',
        'status',
    ];    
}
