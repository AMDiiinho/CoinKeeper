<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SCRIPT para criação ta tabela tb_contas no BD através da migration
        Schema::create('tb_contas', function (Blueprint $table) {
            $table->id();        
            $table->foreignId('usuario_id')
                  ->constrained('tb_usuarios')
                  ->onDelete('cascade');
            /*
            $table->foreignId('usuario_id');
            Cria a coluna usuario_id com o tipo BIGINT UNSIGNED
            adiciona automaticamente o índice para essa coluna.
            */

            $table->enum('banco', ['carteira', 'mastercard', 'visa', 'elo',
                         'itau', 'bancodobrasil', 'caixa', 'santander', 'bradesco', 'nubank', 'inter']);           
            $table->decimal('saldo', 10, 2)->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_contas');
    }
};
