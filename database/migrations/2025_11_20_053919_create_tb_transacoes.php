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
        Schema::create('tb_transacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                  ->constrained('tb_usuarios')
                  ->onDelete('cascade');

            $table->foreignId('cartao_id')
                ->constrained('tb_cartoes')
                ->onDelete('cascade');


            $table->foreignId('categoria_id')->nullable()
                  ->constrained('tb_categorias')
                  ->onDelete('cascade');

            $table->foreignId('subcategoria_id')->nullable()
            ->constrained('tb_subcategorias')
            ->onDelete('set null');

            $table->string('titulo', 80);
            $table->enum('tipo', ['receita', 'despesa', 'transferencia']);
            $table->enum('status', ['pendente', 'pago'])->default('pendente');
            $table->enum('lancamento',['unico', 'recorrente']);
            $table->enum('recorrencia_periodo', ['mensal', 'bimestral', 'trimestral', 
                         'semestral', 'anual', 'semanal', 'quinzenal'])->nullable();
            $table->unsignedInteger('recorrencia_qtd')->nullable();
            $table->decimal('valor', 10,2);
            $table->string('descricao');
            $table->date('data');
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
        Schema::dropIfExists('tb_transacoes');
    }
};
