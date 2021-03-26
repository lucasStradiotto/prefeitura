<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class motoristaFormRequest extends FormRequest
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
            'empresa_id' => 'required',
            'secretaria_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo Nome.',
            'empresa_id.required' => 'Preencha o campo Empresa.',
            'secretaria_id.required' => 'Preencha o campo Secretaría'
        ];
    }
}
