<?php

namespace App\Http\Requests\Admin\Voluntarios\Perfil;

use Illuminate\Foundation\Http\FormRequest;

class GuardarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return allows_permission('guardar_voluntario');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'CodigoReferencia'          => ,
            'Nombres'                   => ['required', 'string'],  
            'Apellidos'                 => ['required', 'string'],  
            'apellidoMaterno'           => ['required', 'string'],  
            'nombreSegundo'             => ['required', 'string'],  
            'Pasaporte'                 => ['required', 'min:9'],
            'FechaNacimiento'           => ['required', 'date'],
            'EstadoCivil'               => ['required', 'numeric'],
            'Pais'                      => ['required', 'numeric'],
            'Ciudad'                    => ['required', 'numeric'],
            'Direccion'                 => ['required', 'string'],
            'Telefono'                  => ['required', 'numeric', 'min:9'],
            'Correo'                    => ['required', 'email'],
            'Universidad'               => ['required', 'numeric'],
            'Facultad'                  => ['required', 'numeric'],
            'Carrera'                   => ['required', 'numeric'],
            'Nivel'                     => ['required'],
            'Tutor'                     => ['required', 'string'],
            'Unidad'                    => ['required', 'numeric'],
            'Departamento'              => ['required', 'numeric'],
            'Proyecto'                  => ['required', 'string'],
            'idtutor'                   => ['required', 'numeric'],
            'FechaInicio'               => ['required', 'date'],
            'FechaFin'                  => ['required', 'date'],
            'Alimentacion'              => ['required', 'numeric'],
            'latitud'                   => ['required'],
            'longitud'                  => ['required'],
            // 'observacion',
            // 'horasDiarias',
            'genero'                    => ['required', 'numeric'],
            'celular'                   => ['nullable', 'min:9'],
            'idtutor'                   => ['required', 'numeric'],
            // 'fecha_extension'
            'chkActa'                   => ['required', 'boolean'],
            'tipoPractica'              => ['required', 'numeric'],
        ];
    }
}
