<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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


Route::get('/', function () { return redirect('/home'); });

Route::get('/home', [HomeController::class, 'home']);

Route::get('/entrar', [HomeController::class, 'entrar'])->name('credenciaisEntrada');

Route::get('/cadastro', [HomeController::class, 'cadastro']);

Route::post('/cadastrarUsuario', [HomeController::class, 'cadastrarUsuario'])->name('dadosCadastro');

Route::post('/login', [HomeController::class, 'logar'])->name('dadosLogin');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');;






Route::get('/usuarios', [HomeController::class, 'listarUsuarios'])->name('listaUsuarios');

Route::get('/filtragemUsuarios', [HomeController::class, 'filtragemUsuarios']);

Route::post('/resultadoFiltragem', [HomeController::class, 'resultadoFiltragem']);

Route::post('/deletarUsuario/{id}', [HomeController::class, 'deletarUsuario'])->name('deletar');

Route::get('/usuarios/{id}/editar', [HomeController::class, 'editarUsuario'])->name('editar');

Route::put('/usuarios/{id}', [HomeController::class, 'salvarAlteracao'])->name('salvarAlteracao');


