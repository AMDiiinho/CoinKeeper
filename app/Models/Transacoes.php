<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = ['usuario_id', 'cartao_id', 'categoria_id', 'subcategoria_id', 
                           'titulo', 'tipo', 'status', 'lancamento', 'recorrencia_periodo', 
                           'recorrencia_qtd', 'valor', 'descricao', 'data'];

    const TIPOS = [
        'receita' => 'Receita',
        'despesa' => 'Despesa',
        'transferencia'=> 'Transferência',
    ];

    const STATUS = [
        'pendente'=> 'Pendente',
        'pago'=> 'Pago',
    ];

    const LANCAMENTO = [
        'unico'=> 'Único',
        'recorrente'=> 'Recorrente',
    ];

    const RECORRENCIA_PERIODO = [
        'mensal' => 'Mensal',
        'bimestral' => 'Bimestral',
        'trimestral' => 'Trimestral',
        'semestral'=> 'Semestral',
        'anual' => 'Anual',
        'semanal'=> 'Semanal',
        'quinzenal'=> 'Quinzenal',
    ];

}
