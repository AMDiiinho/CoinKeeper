<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedefinirSenha extends Model
{
    use HasFactory;

    protected $table = 'tb_redefinir_senha';

    protected $fillable = ['email', 'codigo'];
}
