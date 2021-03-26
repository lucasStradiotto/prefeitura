<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class abastecimentoFormRequest extends FormRequest
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
            'litros' => 'required',
            'motorista' => 'required',
            'valor_unitario' => 'required',
            'tipo_combustivel' => 'required',
            'kilometragem' => 'required',
            'veiculo_id' => 'required',
            'posto_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'litros.required' => 'Preencha o campo Qtd Litros.',
            'motorista.required' => 'Preencha o campo com o nome do Motorista.',
            'valor_unitario.required' => 'Preencha o campo Valor Unitario.',
            'tipo_combustivel.required' => 'Selecione o campo combustivel.',
            'kilometragem.required' => 'Preencha o campo com a kilometragem atual do veiculo.',
            'veiculo_id.required' => 'Preencha o campo com a kilometragem atual do veiculo.',
            'posto_id.required' => 'Erro na identicação do posto.'


        ];
    }
}
