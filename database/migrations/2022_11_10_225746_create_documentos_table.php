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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            $table->string('titulo',100);
            $table->string('autor',100);
            $table->string('resumen');
            $table->string('url');
            $table->date('fecha')->nullable();
            $table->string('formato');
            $table->string('idioma',2);
            $table->boolean('publico')->default(true);
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('categoria_id');
            
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('id')->on('categorias');            
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
        Schema::dropIfExists('documentos');
    }
};
