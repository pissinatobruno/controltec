<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOs extends FormRequest
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
            'numero_os' => 'required|max:15',
            'descricao_servico' => 'max:255',
            'data_execucao' => 'required',
            'data_vencimento' => 'required',
            'cliente_id' => 'required',
            'status_id' => 'required',
            'servico_id' => 'required',
            'tecnico_id' => 'required',
            'auxiliar_id' => 'required',

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
