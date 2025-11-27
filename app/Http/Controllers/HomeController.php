<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\ProcuraRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function entrar(){
        return view('entrar');
    }

    public function cadastro(){
        return view('cadastro');
    }

    public function dashboard()
    {
        $usuario = session('usuario');
        return view('dashboard', compact('usuario'));
    }

    public function contas(){
        $user = Auth::user();
        return view('contas');
    }


    public function logar(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard');
        }
        
        throw new AuthenticationException('Credenciais inválidas.');
    }

    public function cadastrarUsuario(CadastroRequest $request){

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'dataNasc' => $request->dataNasc,
            'ddd' => $request->ddd,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        Auth::login($usuario);

        return redirect()->intended('dashboard');
    }

    public function listarUsuarios(){
        $usuarios = Usuario::all();
        return view('listaUsuarios', ['usuarios' => $usuarios]);
    }

    public function filtragemUsuarios(){
        return view('filtragemUsuarios');
    }

    public function resultadoFiltragem(ProcuraRequest $request){
        
        $dados = $request->all();

        $query = Usuario::query();

        if (!empty($dados['nome'])) {
            $query->where('nome', 'like', '%' . $dados['nome'] . '%');
        }

        if (!empty($dados['dataNasc'])) {
            $query->where('dataNasc', $dados['dataNasc']);
        }   

        if (!empty($dados['email'])) {
            $query->where('email', $dados['email']);
        }

        // Executa a consulta
        $resultados = $query->get();

        // Exibe a view com os resultados
        return view('resultadoFiltragem', compact('resultados', 'dados'));
    }

    public function deletarUsuario($id){

        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('listaUsuarios');
    }

    public function editarUsuario($id){

        $usuario = Usuario::findOrFail($id);
        return view('editarUsuario', compact('usuario'));
    }

    public function salvarAlteracao(Request $request, $id){

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('listaUsuarios');
    }   
}
