<?php

namespace App\Rules\Admin\Voluntarios\Evaluacion;

use Illuminate\Contracts\Validation\Rule;

class CalificacionRango implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value >=0 && $value <= 100;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La calificación ingresada no es la correcta.';
    }
}
