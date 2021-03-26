<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ordemServicoPreventivaFormRequest extends FormRequest
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
            'data_execucao' => 'required',
            'horario_inicio' => 'required',
            'horario_fim' => 'required',
            'veiculo_id' => 'required',
            'descricao' => 'required',
            'servico' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data_execucao.required' => 'Preencha o campo Data de Execução.',
            'horario_inicio.required' => 'Preencha o campo Horário de Início.',
            'horario_fim.required' => 'Preencha o campo Horário de Fim.',
            'veiculo_id.required' => 'Preencha o campo Veículo.',
            'descricao.required' => 'Preencha o campo Descrição do Problema.',
            'servico.required' => 'Preencha o campo Serviço Executado.'
        ];
    }
}
