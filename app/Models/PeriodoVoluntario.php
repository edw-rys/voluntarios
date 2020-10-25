<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'carrera',
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
        'horario_voluntario_id',
        'alimentacion_id',
        'horario',
        'tipo_practica_id',
        'status'
    ]; 

    public function horario() : HasOne
    {
        return $this->hasOne(HorarioVoluntario::class, 'periodo_id', 'id');
    }
    public function departamento() : BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }

    public function unidad() : BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'unidad_id', 'id');
    }

    public function universidad() : BelongsTo
    {
        return $this->belongsTo(Universidad::class, 'universidad_id', 'id');
    }

    public function evaluacion() : HasOne
    {
        return $this->hasOne(Evaluaciones::class, 'periodo_id', 'id');
    }
    public function tipo_practica() : HasOne
    {
        return $this->hasOne(TipoPractica::class, 'codigo', 'tipo_practica_id');
    }
    public function alimentacion() : HasOne
    {
        return $this->hasOne(Alimentacion::class, 'id', 'alimentacion_id');
    }
}
