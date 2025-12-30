<?php

namespace App\Http\Controllers;
use App\Models\Cartao;
use App\Models\Transacoes;
use App\Models\Categoria;
use App\Models\Subcategoria;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $usuario = session('usuario');

        return view('dashboard', compact('usuario'));
    }

    public function carteira(){

        Auth::user();

        $cartoes = Cartao::where('usuario_id', Auth::id())->get();
        $bancos = Cartao::BANCOS;
        $tipos = Cartao::TIPOS;

        return view('carteira', compact('tipos','cartoes','bancos'));
    }

    public function transacoes(){

        Auth::user();

        $transacoes = Transacoes::where('usuario_id', Auth::id())->get();   
        $categorias = Categoria::where('usuario_id', Auth::id())->get();
        $subcategorias = Subcategoria::where('usuario_id', Auth::id())->get();    
        $tipos = Transacoes::TIPOS;
        $status = Transacoes::STATUS;
        $lancamento = Transacoes::LANCAMENTO;
        $recorrencia = Transacoes::RECORRENCIA_PERIODO;
        $cartoes = Cartao::where('usuario_id', Auth::id())->get();
        $icones = Categoria::ICONES;

        return view('transacoes', compact('lancamento', 'transacoes', 'recorrencia','tipos','status', 'cartoes', 'categorias', 'icones'));
    }
}
