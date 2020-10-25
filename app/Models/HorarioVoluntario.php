<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioVoluntario extends Model
{
    use HasFactory;
    protected $table = 'tbwbHorarioVoluntario'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'periodo_id',
        'voluntario_id',
        'lunes_data',
        'martes_data',
        'miercoles_data',
        'jueves_data',
        'viernes_data',
        'sabado_data',
        'domingo_data',
        'status'
    ]; 
}
