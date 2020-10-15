<?php

namespace App\Http\Requests\Client\Password;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_password'      => [ 'required', new StrongPassword],
            'confirm_password'  => 'required|in:'. $this->input('new_password') 
        ];
    }
}
