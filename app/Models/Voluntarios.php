<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'apellidoMaterno',
        'nombreSegundo',
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
        
        'tutorevaluado',
        'idtutor',
        'fecha_extension',
        'chkActa',
        'tipoPractica',
        'FechaFinCertificado'
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

    /**
     * 
     */
    public function departamento() : BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'Departamento', 'id');
    }

    public function unidad() : BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'Unidad', 'id');
    }

    public function pais_detalle() : BelongsTo
    {
        return $this->belongsTo(Pais::class, 'Pais', 'id');
    }

    public function ciudad_detalle() : BelongsTo
    {
        return $this->belongsTo(Ciudad::class, 'Ciudad', 'id');
    }

    public function genero_detalle() : HasOne
    {
        return $this->hasOne(Genero::class, 'codigo', 'genero');
    }

    public function universidad() : BelongsTo
    {
        return $this->belongsTo(Universidad::class, 'Universidad', 'id');
    }
    public function alimentacion() : HasOne
    {
        return $this->hasOne(Alimentacion::class, 'id', 'Alimentacion');
    }

    public function evaluacion() : HasOne
    {
        return $this->hasOne(Evaluaciones::class, 'Pasaporte', 'Pasaporte');
    }
    public function pasatiempo() : HasOne
    {
        return $this->hasOne(Pasatiempo::class, 'idPasatiempo', 'id');
    }
    public function tipo_practica() : BelongsTo
    {
        return $this->belongsTo(TipoPractica::class, 'tipoPractica', 'codigo');
    }

    public function periodos() : HasMany
    {
        return $this->hasMany(PeriodoVoluntario::class, 'voluntario_id', 'id');
    }
    public function ultimo_periodo() : HasMany
    {
        return $this->hasMany(PeriodoVoluntario::class, 'voluntario_id', 'id');
    }

    public function tutor_bspi() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'idtutor');
    }

     public function imagen() : HasOne
    {
        return $this->hasOne(ImagenVoluntario::class, 'id', 'voluntario_id')->where('status', 1);
    }

}
