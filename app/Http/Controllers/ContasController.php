<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContasRequest;
use App\Models\Conta;


class ContasController extends Controller
{
    function contasStore(ContasRequest $request){

        Conta::Create([

            'usuario_id' => auth()->id(),
            'banco' => $request->banco,
            'saldo' => $request->saldo,
 
        ]);
        session()->flash('sucesso', 'Conta criada com sucesso!');
        return redirect()->intended('contas');
    }

    function contasDelete($id){
        $conta = Conta::findOrFail($id);
        $conta->delete();

        return redirect()->intended('contas')->with('sucesso', 'Conta excluída com sucesso!');
    }
}
