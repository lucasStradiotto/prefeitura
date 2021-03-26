<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemCidadeFacilFormRequest extends FormRequest
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
            'display_name' => 'required'
        ];
    }

    public function mesages()
    {
        return [
            'nome.required' => 'Preencha o Nome!',
            'display_name.required' => 'Preencha o Display Name!'
        ];
    }
}
