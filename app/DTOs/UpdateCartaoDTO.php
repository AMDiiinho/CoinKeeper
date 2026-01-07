<?php

namespace App\DTOs;

use App\Http\Requests\CartaoRequest;

class UpdateCartaoDTO {
    
    public function __construct(
        
        public int $id, 
        public string $nome, 
        public string $banco, 
        public string $tipo, 
        public float $limite, 
        public float $saldo, 
        public int $dia_fechamento, 
        public int $dia_vencimento
    ) {}

    public static function makeFromRequest(CartaoRequest $request): self {
        
        return new self(
            $request->id,
            $request->nome,
            $request->banco,
            $request->tipo,
            $request->limite,
            $request->saldo,
            $request->dia_fechamento,
            $request->dia_vencimento
        );
    }

}