<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('identificacao', 150);
            $table->string('razao_social', 150);
            $table->tinyInteger('tipo_inscricao');
            $table->string('inscricao', 18)->unique();
            $table->string('email', 100);
            $table->string('telefone', 20);
            $table->string('endereco', 100);
            $table->string('bairro', 100);
            $table->integer('cep');
            $table->string('cidade', 50);
            $table->string('uf', 2);
            $table->timestamps();

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
        Schema::dropIfExists('empresas');
    }
}
