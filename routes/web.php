<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'home']);

Route::get('/cadastro', [HomeController::class, 'cadastro'])->name('cadastroUsuario');

Route::get('/usuarios', [HomeController::class, 'listarUsuarios'])->name('listaUsuarios');

Route::get('/filtragemUsuarios', [HomeController::class, 'filtragemUsuarios']);

Route::post('/resultadoFiltragem', [HomeController::class, 'resultadoFiltragem']);

Route::post('/dadosUsuario', [HomeController::class, 'cadastrarUsuario']);

Route::post('/deletarUsuario/{id}', [HomeController::class, 'deletarUsuario'])->name('deletar');

Route::get('/usuarios/{id}/editar', [HomeController::class, 'editarUsuario'])->name('editar');

Route::put('/usuarios/{id}', [HomeController::class, 'salvarAlteracao'])->name('salvarAlteracao');


