<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntarios extends Model
{
    use HasFactory;
    
    protected $table = 'tbwbVoluntario'; 

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'CodigoReferencia',
        'Nombres',
        'Apellidos',
        'Pasaporte',
        'FechaNacimiento',
        'EstadoCivil',
        'Edad',
        'Pais',
        'Ciudad',
        'Direccion',
        'Telefono',
        'Correo',
        'Universidad',
        'Facultad',
        'Carrera',
        'Nivel',
        'Tutor',
        'Unidad',
        'Departamento',
        'Proyecto',
        'TutorBspi',
        'Horario',
        'FechaInicio',
        'FechaFin',
        'HorasProgramada',
        'Alimentacion',
        'FechaIngreso',
        'usuario_modificacion',
        'fecha_modificacion',
        'pc_name',
        'latitud',
        'longitud',
        'status',
        'evaluado',
        'observacion',
        'horasDiarias',
        'genero',
        'celular',
        'apellidoMaterno',
        'nombreSegundo',
        'tutorevaluado',
        'idtutor',
        'fecha_extension',
        'chkActa',
        'tipoPractica',
    ];

    /**
     * Get the Username for the user.
     *
     * @return string
     */
    public function username()
    {
        return $this->Username;
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
