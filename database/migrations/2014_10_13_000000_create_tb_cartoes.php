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
        Schema::create('tb_cartoes', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('tb_usuarios')
                  ->onDelete('cascade');


            $table->string('nome')->nullable();
            $table->string('banco');
            $table->enum('tipo', ['credito', 'debito', 'pre-pago']);
            $table->decimal('limite', 10, 2)->nullable();
            $table->decimal('saldo', 10, 2)->default(0);
            $table->unsignedTinyInteger('dia_fechamento')->nullable();
            $table->unsignedTinyInteger('dia_vencimento')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_cartoes');
    }
};
