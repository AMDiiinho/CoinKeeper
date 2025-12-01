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
        return redirect()->intended('contas');
    }
}
