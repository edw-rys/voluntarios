<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoVoluntario extends Model
{
    use HasFactory;
    protected $table = 'tbwbPeriodoVoluntario'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'voluntario_id',
        'universidad_id',
        'facultad_id',
        'carrera_id',
        'nivel',
        'tutor',
        'unidad_id',
        'departamento_id',
        'proyecto',
        'tutor_bspi_id',
        'fecha_inicio',
        'fecha_fin',
        'horas_programada',
        'dlimentacion_id',
        'tutor_bspi_nombre',
        'status'
    ]; 
}
