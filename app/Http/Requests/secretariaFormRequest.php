<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class secretariaFormRequest extends FormRequest
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
            'horario_programado_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo Nome.',
            'horario_programado_id.required' => 'Escolha um Horário Programado.'
        ];
    }
}
