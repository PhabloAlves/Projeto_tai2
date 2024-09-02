<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('users_id');
            $table->string('nome_categoria', 100);
            $table->timestamps();

            $table->foreign('empresas_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_servicos');
    }
}
