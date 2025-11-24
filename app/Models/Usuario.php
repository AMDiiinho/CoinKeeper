<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_usuarios';

    protected $fillable = ['nome', 'dataNasc', 'ddd', 'telefone', 'email', 'senha'];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    protected $hidden = ['senha'];
}
