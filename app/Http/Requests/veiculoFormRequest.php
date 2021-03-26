<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class veiculoFormRequest extends FormRequest
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
            'placa' => 'required',
            'empresa_id' => 'required',
            'id_tipo_veiculo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'placa.required' => 'Preencha a Placa.',
            'empresa_id.required' => 'Preencha a Empresa.',
            'id_tipo_veiculo.required' => 'Preencha o Tipo do Veículo.',
        ];
    }
}
