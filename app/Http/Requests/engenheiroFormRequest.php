<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class engenheiroFormRequest extends FormRequest
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
            'crea' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é requerido!',
            'crea.required' => 'O campo CREA é requerido!'
        ];
    }
}
