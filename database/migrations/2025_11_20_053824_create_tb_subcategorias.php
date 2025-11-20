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
        Schema::create('tb_subcategorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')
                  ->constrained('tb_categorias')
                  ->onDelete('cascade');

            $table->string('nome');
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
        Schema::dropIfExists('tb_subcategorias');
    }
};
