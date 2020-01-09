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
            'nome' => 'required|max:255',
            'num_conta' => 'required|max:15|unique:clientes',
            'documento' => 'required|validacnpjcpf',
            'cep' => 'required|max:9',
            'logradouro' => 'required|max:100',
            'numero' => 'required|max:10',
            'bairro' => 'required|max:100',
            'estado' => 'required|max:2',
            'complemento' => 'max:100',
            'cidade' => 'required|max:50',
            'tp_residencia' => 'required|max:50',
            'pt_referencia' => 'max:50',
            'telefone' => 'required|max:15',
            'telefone2' => 'max:15'

        ];
        
    }

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório',
            'max'  => 'Você ultrapassou o número de caracteres',
            'unique' => 'Este cadastro já foi realizado',
            'validacnpjcpf' => 'CPF/CNPJ invalido',
        ];
    }
}
