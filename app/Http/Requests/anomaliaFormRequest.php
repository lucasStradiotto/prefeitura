<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class anomaliaFormRequest extends FormRequest
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
            'prazo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo Nome!',
            'prazo.required' => 'Preencha o Prazo!'
        ];
    }
}
