<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicos extends FormRequest
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
            'descricao' => 'required|max:255',
            'valor_clt' => 'required|max:8',
            'valor_terc' => 'required|max:8',
            
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'max'  => 'Você ultrapassou o número de caracteres',
        ];
    }
}
