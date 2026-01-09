<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use App\Http\Requests\RedefinicaoSenhaRequest;
use App\Mail\AlteracaoDeSenha;
use App\Models\Usuario;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\RedefinirSenha;
use Illuminate\Support\Str;           


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

    public function esqueciMinhaSenha() {

        return view('esqueciMinhaSenha');
    }

    public function email(Request $request) {

        $buscaUsuario = Usuario::where('email', $request->email)->first();

        if(!empty($buscaUsuario)) {

            $codigo = str_replace('.', '', microtime(true)). \Str::random(10);

            $new = RedefinirSenha::create([
                'codigo' => $codigo,
                'email' => $request->email
            ]);

            $url = route('validaCodigo', ['codigo' => $new->codigo]);

            $data = array_merge($new->toArray(), [
                'url' => $url,
            ]);

            Mail::to('arthur.marques@loglabdigital.com.br')->send(new AlteracaoDeSenha($data));

            return view('confirmarEmail');
        }

    }

    public function valida(Request $request) {
        
        $codigo = RedefinirSenha::where('codigo', $request->codigo)->first();

        return view('alterarSenha', [
            'codigo' => $codigo
        ]);
    }

    public function redefinirSenha (RedefinicaoSenhaRequest $request, $codigo) {


        $findCodigo = RedefinirSenha::where('codigo', $codigo)->first();

        if(!empty($findCodigo)){

            $buscaUsuario = Usuario::where("email", $findCodigo->email)->first();


            $buscaUsuario->senha =  bcrypt($request->novaSenha);

            if($buscaUsuario->save()){
              
                return back()->with('success', 'Senha alterada com sucesso!')
                            ->with('redirect', route('credenciaisEntrada'));

            }

        }
    }

    /*

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
    */   
}
    