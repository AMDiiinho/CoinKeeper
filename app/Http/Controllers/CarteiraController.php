<?php

namespace App\Http\Controllers;
use App\DTOs\UpdateCartaoDTO;
use App\Http\Requests\CartaoRequest;
use App\Models\Cartao;
use App\Services\CartaoService;
use App\DTOs\CreateCartaoDTO;


class CarteiraController extends Controller
{

    public function __construct(protected CartaoService $service) {
        

    }

    public function cartaoStore(CartaoRequest $request){

        /*
        Cartao::create([
            'usuario_id'     => auth()->id(),
            'nome'           => $request->input('nome'),
            'banco'          => $request->input('banco'),
            'tipo'           => $request->input('tipo'),
            'limite'         => $request->input('limite'),
            'saldo'          => $request->input('saldo'),
            'dia_fechamento' => $request->input('dia_fechamento'),
            'dia_vencimento' => $request->input('dia_vencimento'),
        ]);
        */

        $this->service->new(CreateCartaoDTO::makeFromRequest($request));

        session()->flash('sucesso', 'Cartão criado com sucesso!');
        return redirect()->intended('carteira');
    }

    public function cartaoDelete(string|int $id){
        
        $this->service->delete($id);

        return redirect()->back()->with('sucesso', 'cartão excluído com sucesso!');
    }

    public function cartaoUpdate(CartaoRequest $request, $id)
    {

        
        $cartao = Cartao::findOrFail($id);

        $cartao->update($request->validated());

    
        //$cartao = $this->service->update(UpdateCartaoDTO::makeFromRequest($request));

        //if(!$cartao){
        //    return back();
        //}

        return redirect()->back()->with('sucesso', 'Cartão atualizado!');
    }

}
