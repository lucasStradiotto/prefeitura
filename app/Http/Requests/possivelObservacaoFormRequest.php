<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class possivelObservacaoFormRequest extends FormRequest
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
            'secretaria_id' => 'required',
            'nome_observacao' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'secretaria_id.required' => 'Secretaria é obrigatório.',
            'nome_observacao.required' => 'Preencha o nome da Observação.'
        ];
    }
}
