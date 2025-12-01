<?php

namespace App\Http\Controllers;
use App\Models\Contas;

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
        return view('contas', ['bancos' => Contas::BANCOS]);
    }
}
