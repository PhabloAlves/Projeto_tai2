<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('empresas_id');
            $table->integer('ordem');
            $table->string('titulo', 100);
            $table->mediumText('texto')->nullable();

            // Chaves estrangeiras
            $table->foreign('users_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('empresas_id')->references('id')->on('empresas')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('textos');
    }
}
