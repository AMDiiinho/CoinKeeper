<?php

namespace App\Http\Controllers;
use App\Models\Cartao;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $usuario = session('usuario');
        //$cartoes = Cartao::where('usuario_id', Auth::id())->get();
        //$bancos = Cartao::BANCOS;

        return view('dashboard', compact('usuario'));
    }

    public function carteira(){

        Auth::user();

        $cartoes = Cartao::where('usuario_id', Auth::id())->get();
        $bancos = Cartao::BANCOS;
        $tipos = Cartao::TIPOS;

        return view('carteira', compact('tipos','cartoes','bancos'));
    }
}
