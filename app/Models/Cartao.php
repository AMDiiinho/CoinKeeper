<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $table = 'tb_cartoes';
    protected $fillable = [
        'usuario_id', 'nome', 'banco', 'tipo', 'limite', 'saldo', 'dia_fechamento', 'dia_vencimento'
    ];

    const BANCOS = [

        'carteira'          => 'Carteira',
        'mastercard'        => 'Mastercard',
        'visa'              => 'Visa',
        'elo'               => 'Elo',
        'itau'              => 'Itaú',
        'bancodobrasil'     => 'Banco do Brasil',
        'caixa'             => 'Caixa',
        'santander'         => 'Santander',
        'bradesco'          => 'Bradesco',
        'nubank'            => 'Nubank',
        'inter'             => 'Inter'

    ];

    const TIPOS = [
        'pre-pago'          => 'Pré-pago',
        'credito'           => 'Crédito',
        'debito'            => 'Débito'
    ];
}
