<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('funcionarios_id');
            $table->unsignedBigInteger('servicos_id');
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('empresas_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('funcionarios_id')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('servicos_id')->references('id')->on('servicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
