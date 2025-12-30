<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    function categoriaStore(CategoriaRequest $request) {

        $categoria = Categoria::create([
            'usuario_id'        => auth()->id(),
            'nome'              => $request->input('nome'),
            'cor'               => $request->input('cor'),
            'icone'             => $request->input('icone')     
        ]);

        return response()->json([ 
            'id' => $categoria->id, 
            'nome' => $categoria->nome, 
        ], 201);
    }


    function categoriaListar(){
        
        $categorias = Categoria::where('usuario_id', auth()->id())
            -> orderBy('nome')
            -> get(['id', 'nome']);

        return response()->json($categorias);
    }

}
