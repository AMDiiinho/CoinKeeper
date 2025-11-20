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
        Schema::create('tb_categorias', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('usuario_id')
                  ->constrained('tb_usuarios')
                  ->onDelete('cascade');

            $table->string('nome', 80);
            $table->string('cor', 7);
            $table->string('icone');
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
        Schema::dropIfExists('tb_categorias');
    }
};
