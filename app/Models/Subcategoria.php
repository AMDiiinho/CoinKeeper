<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategoria extends Model
{
    use HasFactory;

    protected $table = "tb_subcategorias";

    protected $fillable = ['usuario_id', 'categoria_id', 'nome'];
}
