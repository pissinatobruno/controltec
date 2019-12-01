<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|max:255|min:8',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'max'  => 'Você ultrapassou o número de caracteres',
            'unique' => 'Email já cadastrado',
            'min'  => 'Utilize uma senha com no minimo 8 caracteres.',

        ];
    }
}
