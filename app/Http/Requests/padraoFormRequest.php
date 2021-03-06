<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class padraoFormRequest extends FormRequest
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
            'tipo_padrao_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo Nome.',
            'tipo_padrao_id.required' => 'Preencha o campo Tipo de Padrão.'
        ];
    }
}
