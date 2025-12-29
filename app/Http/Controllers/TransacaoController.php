<?php

namespace App\Http\Controllers;
use App\Models\Transacoes;
use App\Http\Requests\TransacaoRequest;

use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    function transacaoStore(TransacaoRequest $request){
        Transacoes::create([
            'usuario_id'            => auth()->id(),
            'cartao_id'             => $request->input('cartao'),
            'categoria_id'          => 1,
            'subcategoria_id'       => 1,
            'titulo'                => $request->input('titulo'),
            'status'                => $request->input('status'),
            'lancamento'            => $request->input('lancamento'),
            'recorrencia_periodo'   => $request->input('recorrencia_periodo'),
            'recorrencia_qtd'       => $request->input('recorrencia_qtd'),
            'valor'                 => $request->input('valor'),
            'descricao'             => $request->input('descricao'),
            'data'                  => $request->input('data')
        ]);

        session()->flash('sucesso', 'Transação registrada com sucesso!');
        return redirect()->intended('transacoes');
    }
}
