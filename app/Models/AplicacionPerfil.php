<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionPerfil extends Model
{
    use HasFactory;
    protected $table = 'SG_OPCION_APLICACION'; 

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
        'codigo',
        'descripcion',
        'imagen',
        'tipo',
        'ejecutable',
        'usuario_ingreso',
        'fecha_ingreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pcname',
        'status',
    ];    
}
