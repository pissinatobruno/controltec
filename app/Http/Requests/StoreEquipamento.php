<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipamento extends FormRequest
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
            'descricao' => 'required|max:255|unique:equipamentos',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'max'  => 'Você ultrapassou o número de caracteres',
            'unique' => 'Equipamento já cadastrado'
        ];
    }
}
