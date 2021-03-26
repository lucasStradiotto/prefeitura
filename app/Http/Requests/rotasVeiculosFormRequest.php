<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class rotasVeiculosFormRequest extends FormRequest
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
            'rota_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'veiculo_id.required' => 'O veículo é obrigatório',
            'rota_id.required' => 'A rota é obrigatória'
        ];
    }
}
