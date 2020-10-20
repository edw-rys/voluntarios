<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Factory as ValidationFactory;

class RequestTest extends FormRequest
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
      dd($this->input());
        return [
            'x'=> 'required'
        ];
    }
    // protected function failedValidation(Validator $validator) { 
    //     throw new HttpResponseException(
    //       response()->json([
    //         'status' => false,
    //         'messages' => $validator->errors()->all()
    //       ], 200)
    //     ); 
    //   }
    public function response(array $errors)
    {
        // if ($this->expectsJson()) {
        // }
        dd($errors);
        return new JsonResponse($errors, 422);
        // return $this->redirector->to($this->getRedirectUrl())
        //     ->withInput($this->except($this->dontFlash))
        //     ->withErrors($errors, $this->errorBag);
    }
}
