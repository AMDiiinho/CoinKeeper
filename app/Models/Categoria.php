<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "tb_categorias";

    protected $fillable = ['usuario_id', 'nome', 'cor', 'icone'];

    public const ICONES = [ 'wallet', 'shopping-cart', 'coffee', 'car', 'food', 
    'gift', 'health', 'education', 'travel', 'home',];
}



