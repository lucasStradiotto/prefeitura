<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class exameFormRequest extends FormRequest
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
            'nome' => 'required',
            'tipo_exame_id' => 'required',
            'tipo_padroes_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo Nome.',
            'tipo_exame_id.required' => 'Preencha o campo Tipo Exame.',
            'tipo_padroes_id.required' => 'Preencha o campo Tipo Padrões.'
        ];
    }
}
