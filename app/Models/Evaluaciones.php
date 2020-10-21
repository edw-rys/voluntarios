<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Evaluaciones extends Model
{
    use HasFactory;
    protected $table = 'tbwbEvaluacionAlVoluntario'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        'CodigoReferencia',
        'Pasaporte',
        'txt1',
        'txt2',
        'txt3',
        'txt4',
        'txt5',
        'txt6',
        'txt7',
        'txt8',
        'txt9',
        'txt10',
        'txt11',
        'txt12',
        'txt13',
        'txt14',
        'txt15',
        'txt16',
        'txt17',
        'txt18',
        'txt19',
        'txt20',
        'txt21',
        'txt22',
        'txtsi',
        'txtno',
        'FechaIngreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pc_name',
        'status',
    ];    

    /**
     * Relaciones
     * @return HasOne
     */
    public function voluntatio() : HasOne
    {
        return $this->hasOne(Voluntarios::class, 'Pasaporte', 'Pasaporte');
    }

}

