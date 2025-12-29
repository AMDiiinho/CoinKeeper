<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "tb_categorias";

    protected $fillable = ['usuario_id', 'nome', 'cor', 'icone'];


    public const CORES = [ '#FF6B6B', '#FF8A65', '#FFD166', '#06D6A0', 
    '#4D96FF', '#845EC2', '#FF9671', '#2C73D2', '#00C9A7', '#F9F871', 
    '#E76F51', '#9B5DE5', '#00B4D8', '#F15BB5', '#6A4C93' ]; 
    
    
    public const ICONES = [ 'carteira', 'carrinho-de-compras', 'cafe', 'carro', 'comida', 
    'presente', 'saude', 'educacao', 'viagens', 'casa',];
}



