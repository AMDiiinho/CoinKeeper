<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'banco' => 'required|in:' . implode(',', array_keys(\App\Models\Conta::BANCOS)),
            'saldo'=> 'required|numeric|min:0
            |regex:/^\d{1,8}(\. \d{1,2})?$/',
        ];
    }

    public function messages(){

        return [
            'banco.required' => 'Selecione um banco válido.',
            'saldo.required'=> 'Informe o saldo inicial.',
            'saldo.numeric' => 'O saldo deve ser um número.'
        ];
    }
}
