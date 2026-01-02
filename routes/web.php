<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarteiraController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use Faker\Guesser\Name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    ====================================================================================================

        ROTAS REFERENTES À TELA INICIAL DA APLICAÇÃO, ANTES DO LOGIN

    ====================================================================================================
*/


Route::get('/', function () { return redirect('/home'); });

Route::get('/home', [HomeController::class, 'home']);

Route::get('/entrar', [HomeController::class, 'entrar'])->name('credenciaisEntrada');

Route::get('/cadastro', [HomeController::class, 'cadastro']);

Route::post('/cadastrarUsuario', [HomeController::class, 'cadastrarUsuario'])->name('dadosCadastro');

Route::post('/login', [HomeController::class, 'logar'])->name('dadosLogin');




/*
    ====================================================================================================

        ROTAS REFERENTES AO DASHBOARD

    ====================================================================================================
*/


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/carteira', [DashboardController::class, 'carteira'])->middleware('auth');

Route::get('/transacoes', [DashboardController::class, 'transacoes'])->middleware('auth');



/*
    ====================================================================================================

        ROTAS REFERENTES À TELA "MINHAS CONTAS"

    ====================================================================================================
*/


Route::post('/carteira', [CarteiraController::class, 'cartaoStore'])->middleware('auth')->name('dadosCartao');

Route::delete('/carteira/{id}', [CarteiraController::class, 'cartaoDelete'])->middleware('auth')->name('excluiCartao');

Route::patch('/carteira/{id}', [CarteiraController::class,'cartaoUpdate'])->middleware('auth')->name('atualizaCartao');


/*
    ====================================================================================================

        ROTAS REFERENTES À TELA TRANSAÇÕES

    ====================================================================================================
*/

Route::post('/transacoes', [TransacaoController::class, 'transacaoStore'])->middleware('auth')->name('transacaoStore');



/*
    ====================================================================================================

        ROTAS REFERENTES À CATEGORIAS E SUBCATEGORIAS

    ====================================================================================================
*/

Route::post('/categorias', [CategoriaController::class, 'categoriaStore'])->middleware('auth')->name('categoriaStore');

Route::get('/categorias', [CategoriaController::class, 'categoriaListar'])->middleware('auth');

Route::post('/subcategorias', [SubcategoriaController::class, 'subcategoriaStore'])->middleware('auth')->name('subcategoriaStore');

Route::get('/subcategorias', [SubcategoriaController::class, 'retornaJson']) ->middleware('auth') ->name('subcategorias.listar');



/*
Route::get('/usuarios', [HomeController::class, 'listarUsuarios'])->name('listaUsuarios');

Route::get('/filtragemUsuarios', [HomeController::class, 'filtragemUsuarios']);

Route::post('/resultadoFiltragem', [HomeController::class, 'resultadoFiltragem']);

Route::post('/deletarUsuario/{id}', [HomeController::class, 'deletarUsuario'])->name('deletar');

Route::get('/usuarios/{id}/editar', [HomeController::class, 'editarUsuario'])->name('editar');

Route::put('/usuarios/{id}', [HomeController::class, 'salvarAlteracao'])->name('salvarAlteracao');

*/
