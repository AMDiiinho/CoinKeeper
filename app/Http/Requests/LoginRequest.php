<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Auth\AuthenticationException;

class LoginRequest extends FormRequest
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

    //sobrescrevi o método para que qualquer entrada inválida faça com que apareça o erro de autenticação de login
    //mantém a segurança ao invés de dar detalhes de qual campo está errado e o que está errado exatamente
    protected function failedValidation(Validator $validator)
    {
        throw new AuthenticationException('Credenciais inválidas.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'      => 'required|email',
            'password'      => 'required|string'
        ];
    }
}
