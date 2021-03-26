<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ordemColetaFormRequest extends FormRequest
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
            'nome_solicitante' => 'required',
            'valor' => 'required',
            'numero_ctr' => 'required',
            'material_predominante_id' => 'required',
            'endereco_cobranca_id' => 'required',
            'bairro_cobranca_id' => 'required',
            'numero_casa_cobranca_id' => 'required',
            'endereco_obra_id' => 'required',
            'bairro_obra_id' => 'required',
            'veiculo_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome_solicitante.required' => 'Preencha o campo Nome!',
            'valor.required' => 'Preencha o campo Valor!',
            'numero_ctr.required' => 'Preencha o campo Número CTR!',
            'material_predominante_id.required' => 'Preencha o campo Tipo de Material!',
            'endereco_cobranca_id.required' => 'Preencha o campo Endereço de Cobrança!',
            'bairro_cobranca_id.required' => 'Preencha o campo Bairro de Cobrança!',
            'numero_casa_cobranca_id.required' => 'Preencha o campo Número da Casa!',
            'endereco_obra_id.required' => 'Preencha o campo Endereço da Obra!',
            'bairro_obra_id.required' => 'Preencha o campo Bairro da Obra!',
            'veiculo_id.required' => 'Preencha o campo Veículo!'
        ];
    }
}
