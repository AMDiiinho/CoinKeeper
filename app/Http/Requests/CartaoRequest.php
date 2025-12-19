<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cartao;

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
            'dia_fechamento' => 'nullable|integer|min:1|max:31',
            'dia_vencimento' => 'nullable|integer|min:1|max:31',
        ];

        if ($this->isMethod('post')) {
            // Criação
            $rules['banco'] = 'required|string|max:40';
            $rules['tipo']  = 'nullable|in:credito,debito,pre-pago';

            if ($this->input('banco') !== 'carteira') {
                $rules['tipo'] = 'required|in:credito,debito,pre-pago';

                if ($this->input('tipo') === 'credito') {
                    $rules['limite']     = 'required|numeric|min:0';
                    $rules['dia_fechamento'] = 'required|integer|min:1|max:31';
                    $rules['dia_vencimento'] = 'required|integer|min:1|max:31';
                }
            }

            $rules['saldo'] = 'required|numeric|min:0';
        }

        if ($this->isMethod('patch')) {
            $cartao = Cartao::find($this->route('id'));

            $rules['banco'] = 'prohibited';
            $rules['tipo']  = 'prohibited';

            if ($cartao->tipo === 'credito') {
                $rules['limite']     = 'required|numeric|min:0';
                $rules['dia_fechamento'] = 'required|integer|min:1|max:31';
                $rules['dia_vencimento'] = 'required|integer|min:1|max:31';
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
        // Define qual "sacola" de erros usar baseado no verbo HTTP
        $errorBag = $this->isMethod('post') ? 'create' : 'edit';

        $response = redirect()->back()
            ->withErrors($validator, $errorBag) // Segundo parametro é a bag
            ->withInput();

        // Se for edição, precisamos persistir o ID para o JS saber qual URL montar
        if ($this->isMethod('patch')) {
            session()->flash('editar_cartao_id', $this->route('id'));
        }

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
