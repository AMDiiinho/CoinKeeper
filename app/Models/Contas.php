<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    use HasFactory;

    protected $table = 'tb_contas';
    protected $fillable = ['usuario_id', 'banco' , 'saldo'];

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
}
