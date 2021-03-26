<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoligonoFormRequest extends FormRequest
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
            'tipo_poligono_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o Nome.',
            'tipo_poligono_id.required' => 'O Poligono deve ter um Tipo.'
        ];
    }
}
