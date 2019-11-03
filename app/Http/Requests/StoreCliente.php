<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCliente extends FormRequest
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
            'cliente.nome' => 'required|max:255',
            'cliente.documento' => 'required|max:14',
            'cliente.num_conta' => 'max:50',
            'endereco.cep' => 'required|max:8',
            'endereco.logradouro' => 'required|max:100',
            'endereco.numero' => 'required|max:10',
            'endereco.bairro' => 'required|max:100',
            'endereco.estado' => 'required|max:2',
            'endereco.complemento' => 'max:100',
            'endereco.cidade' => 'required|max:50',
            'endereco.tp_residencia' => 'required|max:50',
            'endereco.pt_referencia' => 'max:50',
            'telefone.*.numero' => 'max:50'
        ];
        
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'max'  => 'Você ultrapassou o número de caracteres'
        ];
    }
}
