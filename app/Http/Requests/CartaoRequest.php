<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartaoRequest extends FormRequest
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
            'banco'      => 'required|string|max:80',
            'tipo'       => 'required|in:credito,debito,pre-pago',
            'limite'     => 'nullable|numeric|min:0',
            'saldo'      => 'nullable|numeric|min:0',
            'fechamento' => 'nullable|integer|min:1|max:31',
            'vencimento' => 'nullable|integer|min:1|max:31',
        ];
    }

    public function messages(){

        return [
            'tipo.in' => 'O tipo do cartão deve ser Crédito, Débito ou Pré-pago.',
        ];
    }
}
