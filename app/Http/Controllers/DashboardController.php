<?php

namespace App\Http\Controllers;
use App\Models\Conta;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $usuario = session('usuario');
        return view('dashboard', compact('usuario'));
    }

    public function contas(){

        Auth::user();

        $contas = Conta::where('usuario_id', Auth::id())->get();
        $bancos = Conta::BANCOS;

        return view('contas', compact('contas', 'bancos'));
    }
}
