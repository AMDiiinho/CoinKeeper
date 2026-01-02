<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubcategoriaRequest;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function subcategoriaStore(SubcategoriaRequest $request) {
        
        $subcategoria = Subcategoria::create([
            
            'usuario_id'    => auth()->id(),
            'categoria_id'  => $request->input('categoria-subcategoria'),
            'nome'          => $request->input('nome'),
        ]);

        return response()->json([ 
            'id' => $subcategoria->id, 
            'nome' => $subcategoria->nome, 
            'categoria_id' => $subcategoria->categoria_id, 
        ], 201);
    }   

     public function retornaJson(Request $request) { 

        $categoriaId = $request->query('categoria_id'); 

        $query = Subcategoria::where('usuario_id', auth()->id());
         
        if ($categoriaId) { 
            $query->where('categoria_id', $categoriaId); 
        }

        $subcategorias = $query->orderBy('nome')->get(['id', 'nome', 'categoria_id']); 
        
        return response()->json($subcategorias); }
}
