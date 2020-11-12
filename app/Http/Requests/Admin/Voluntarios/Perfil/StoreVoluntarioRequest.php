<?php

namespace App\Http\Requests\Admin\Voluntarios\Perfil;

use App\Repositories\VoluntariosRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVoluntarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//allows_permission('guardar_voluntario');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $voluntario = (new VoluntariosRepository())->getModel()->getTable();
        return [
            // 'CodigoReferencia'          => ,
            'Nombres'                   => ['required', 'string'],  
            'Apellidos'                 => ['required', 'string'],  
            'apellidoMaterno'           => ['required', 'string'],  
            'nombreSegundo'             => ['required', 'string'],  
            'imagen'                    => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:4048',
            'Pasaporte'                 => ['required', 'min:9', Rule::unique($voluntario, 'Pasaporte')->where('status',1)],
            'FechaNacimiento'           => ['required', 'date'],
            'EstadoCivil'               => ['required', 'numeric'],
            'Pais'                      => ['required', 'numeric'],
            'Ciudad'                    => ['required', 'numeric'],
            'Direccion'                 => ['required', 'string'],
            'Telefono'                  => ['nullable', 'numeric'],
            'Correo'                    => ['required', 'email'],
            'Universidad'               => ['required', 'numeric'],
            'Facultad'                  => ['required', 'numeric'],
            'Carrera'                   => ['required'],
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
            'chkActa'                   => ['required'],
            'tipoPractica'              => ['required', 'numeric'],
        ];
    }
}
