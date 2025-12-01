<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('contas');
    }
}
