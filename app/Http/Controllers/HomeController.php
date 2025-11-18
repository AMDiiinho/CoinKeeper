<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\ProcuraRequest;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function cadastro(){
        return view('cadastro');
    }

    public function cadastrarUsuario(CadastroRequest $request){

        Usuario::create($request->validated());
        return view('dadosUsuario');
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
