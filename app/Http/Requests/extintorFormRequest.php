<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class extintorFormRequest extends FormRequest
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
            'inscricao' => 'required',
            'validade' => 'required',
            'tipo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inscricao.required' => 'O campo Inscrição é requerido!',
            'validade.required' => 'O campo Validade é requerido!',
            'tipo.required' => 'O campo Tipo é requerido!'
        ];
    }
}