<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class preventivaFormRequest extends FormRequest
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
            'intervalo' => 'required',
            'veiculo_id' => 'required',
            'tipo_preventiva_id' => 'required',
            'unidade_intervalo_id' => 'required',
            'data_ultima_manutencao' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'intervalo.required' => 'Preencha o campo Intervalo.',
            'veiculo_id.required' => 'Preencha o campo Veículo.',
            'tipo_preventiva_id.required' => 'Preencha o campo Preventiva.',
            'unidade_intervalo_id.required' => 'Preencha o campo Unidade de Intervalo.',
            'data_ultima_manutencao.required' => 'Preencha a Data da Última Manutenção.'

        ];
    }
}
