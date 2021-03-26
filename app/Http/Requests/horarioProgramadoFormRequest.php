<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class horarioProgramadoFormRequest extends FormRequest
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
            'inicio' => 'required',
            'fim' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inicio.required' => 'Preencha o Inicio',
            'fim.required' => 'Preencha o Fim'
        ];
    }
}
