<?php

namespace App\Http\Requests\Admin\Voluntarios\Evaluacion;

use App\Rules\Admin\Voluntarios\Evaluacion\CalificacionRango;
use App\Rules\Admin\Voluntarios\Evaluacion\CalificacionSINO;
use App\Rules\Admin\Voluntarios\Evaluacion\ExisteCedula;
use Illuminate\Foundation\Http\FormRequest;

class EvaluacionRequest extends FormRequest
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
        $rules_vals = [
            'CodigoReferencia' => ['required', 'integer', new ExisteCedula],
            'txtrecomendado'   => ['required', new CalificacionSINO]
        ];
        for ($i=1; $i <= 22 ; $i++) { 
            $rules_vals = array_merge($rules_vals , ['txt'.$i => [ 'required', 'numeric', new CalificacionRango]]);
            // $rules_vals .= ['txt'.$i => [ 'required', 'numeric', new CalificacionRango]];
        }
        return $rules_vals;
    }

    
}
