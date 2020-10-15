<?php

namespace App\Http\Requests\Client\Profile;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $user   = (new UserRepository())->getModel()->getTable();

        return [
            'email'       => ['required', 'string', 'max:255', 'email:rfc,dns', Rule::unique($user, 'email')->whereIn('status', ['active'])->whereNull('deleted_at')],
            'first_name'  => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'last_name'   => ['required', 'string', 'max:255'],
            'source_name' => ['required', 'string', 'max:255'],
            'address'     => ['required', 'string', 'max:255'],
        ];
    }
}
