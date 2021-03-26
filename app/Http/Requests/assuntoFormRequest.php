<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class assuntoFormRequest extends FormRequest
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
            'tipo_assunto_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é requerido!',
            'tipo_assunto_id.required' => 'Selecione um grupo para o Assunto'
        ];
    }
}
