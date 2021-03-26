<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postosDeGasolinaFormRequest extends FormRequest
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
            'cnpj' => 'required',
            'cidade' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é requerido!',
            'cnpj.required' => 'O campo cnpj é requerido!',
            'cidade.required' => 'O campo cidade é requerido!'
        ];
    }
}
