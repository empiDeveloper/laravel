<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetUsersRequest extends FormRequest
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
            'skip' => ['required', 'numeric'],
            'limit' => ['required', 'numeric'],
        ];
    }
    /**
     * Messages validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'skip.required' => 'El parámetro skip es requerido',
            'skip.numeric' => 'El parámetro skip debe contener solo caracteres numéricos',
            'limit.required' => 'El parámetro limit es requerido',
            'limit.numeric' => 'El parámetro limit debe contener solo caracteres numéricos',
        ];
    }
}
