<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class empresaFormRequest extends FormRequest
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
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cnpj' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'razao_social.required' => 'Preencha a Razão Social',
            'nome_fantasia.required' => 'Preencha o Nome Fantasia',
            'cnpj.required' => 'Preencha o CNPJ'
        ];
    }
}
