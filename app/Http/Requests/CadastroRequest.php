<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
            'nome'       => 'required|string|max:80',
            'dataNasc'   => 'required|date',
            'ddd'        => 'required|digits:2',
            'telefone'   => 'required|string|max:15',
            'email'      => 'required|email|max:80|unique:tb_usuarios,email',
            'senha'      => 'required|string|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'senha.confirmed' => 'As senhas não coincidem.',
        ];
    }
}
