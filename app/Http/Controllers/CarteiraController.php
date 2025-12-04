<?php

namespace App\Http\Controllers;
use App\Http\Requests\CartaoRequest;
use App\Models\Cartao;


class CarteiraController extends Controller
{
    function cartaoStore(CartaoRequest $request){

        Cartao::create([
            'usuario_id'     => auth()->id(),
            'nome'           => $request->input('nome'),
            'banco'          => $request->input('banco'),
            'tipo'           => $request->input('tipo'),
            'limite'         => $request->input('limite'),
            'saldo'          => $request->input('saldo'),
            'dia_fechamento' => $request->input('fechamento'),
            'dia_vencimento' => $request->input('vencimento'),
        ]);

        session()->flash('sucesso', 'Cartao criado com sucesso!');
        return redirect()->intended('carteira');
    }

    function cartaoDelete($id){
        $cartao = Cartao::findOrFail($id);
        $cartao->delete();

        return redirect()->intended('carteira')->with('sucesso', 'cartão excluído com sucesso!');
    }
}
