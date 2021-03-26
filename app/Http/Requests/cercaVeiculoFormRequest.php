<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cercaVeiculoFormRequest extends FormRequest
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
            'veiculo_id' => 'required',
            'cerca_id' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'acao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'veiculo_id.required' => 'Preencha o Veículo.',
            'cerca_id.required' => 'Preencha a Cerca.',
            'data_inicio.required' => 'Preencha a Data Início.',
            'data_fim.required' => 'Preencha a Data Fim.',
            'acao.required' => 'Preencha a Ação.',
        ];
    }
}
