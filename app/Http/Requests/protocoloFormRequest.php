<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class protocoloFormRequest extends FormRequest
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
            'l' => 'required|unique:protocolos',
//            'status' => 'required',
//            'assunto' => 'required',
//            'proprietario' => 'required',
//            'setor' => 'required',
//            'quadra' => 'required',
//            'lote' => 'required',
//            'data_retirada' => 'required',
//            'data_inicio' => 'required',
//            'data_fim' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'l.required' => 'O campo l é requerido!',
            'l.unique' => 'Um protocolo com este número já existe!'
//            'status.required' => 'O campo status é requerido!',
//            'assunto.required' => 'O campo assunto é requerido!',
//            'proprietario.required' => 'O campo proprietario é requerido!',
//            'setor.required' => 'O campo setor é requerido!',
//            'quadra.required' => 'O campo quadra é requerido!',
//            'lote.required' => 'O campo lote é requerido!',
//            'data_retirada.required' => 'O campo Data Retirada é requerido!',
//            'data_inicio.required' => 'O campo Data Início é requerido!',
//            'data_fim.required' => 'O campo Data Fim é requerido!'
        ];
    }
}
