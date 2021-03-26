<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tipoAssuntoFormRequest extends FormRequest
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
            'grupo' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'grupo.required' => 'O campo grupo é obrigatório!'
        ];
    }
}
