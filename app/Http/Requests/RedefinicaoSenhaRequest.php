<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedefinicaoSenhaRequest extends FormRequest
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
            'novaSenha' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'novaSenha.min' => 'A senha precisa conter, no mínimo 8 caracteres!',
            'novaSenha.confirmed' => 'As senhas não coicidem!'
        ];
    }
}
