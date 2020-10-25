<?php

namespace App\Http\Requests\Admin\Voluntarios\Perfil;

use App\Rules\Admin\Voluntarios\Evaluacion\ExisteCedula;
use Illuminate\Foundation\Http\FormRequest;

class CambioPeriodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'voluntario_id'             => ['required', 'numeric', new ExisteCedula],
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
            // 'observacion',
            // 'horasDiarias',
            'idtutor'                   => ['required', 'numeric'],
            // 'fecha_extension'
            'chkActa'                   => ['required'],
            'tipoPractica'              => ['required', 'numeric'],
        ];
    }
}
