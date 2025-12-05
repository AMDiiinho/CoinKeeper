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
    public function rules(){
        $rules = [
            'nome'       => 'required|string|max:40',
            'limite'     => 'nullable|numeric|min:0',
            'saldo'      => 'nullable|numeric|min:0',
            'fechamento' => 'nullable|integer|min:1|max:31',
            'vencimento' => 'nullable|integer|min:1|max:31',
        ];

        if ($this->isMethod('post')) {
            // Criação
            $rules['banco'] = 'required|string|max:40';
            $rules['tipo']  = 'nullable|in:credito,debito,pre-pago';

            if ($this->input('banco') !== 'carteira') {
                $rules['tipo'] = 'required|in:credito,debito,pre-pago';

                if ($this->input('tipo') === 'credito') {
                    $rules['limite']     = 'required|numeric|min:0';
                    $rules['fechamento'] = 'required|integer|min:1|max:31';
                    $rules['vencimento'] = 'required|integer|min:1|max:31';
                }
            }

            $rules['saldo'] = 'required|numeric|min:0';
        }

        if ($this->isMethod('patch')) {
            // Edição
            // Banco e tipo não são exigidos (frontend bloqueia)
            if ($this->input('tipo') === 'credito') {
                $rules['limite']     = 'required|numeric|min:0';
                $rules['fechamento'] = 'required|integer|min:1|max:31';
                $rules['vencimento'] = 'required|integer|min:1|max:31';
            }
        }

        return $rules;
    }


    public function messages(){

        return [
            'tipo.in' => 'O tipo do cartão deve ser Crédito, Débito ou Pré-pago.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('editar_cartao_id', $this->route('id')); // pega o id da rota

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
