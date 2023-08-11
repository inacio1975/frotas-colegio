<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero')->unique();
            $table->string('nome');
            $table->unsignedInteger('idade');
            $table->string('sexo');
            $table->string('classe');
            $table->string('turno');
            $table->string('morada');
            $table->string('nome_encarregado');
            $table->string('telefone');
            $table->unsignedBigInteger('rota_id');
            $table->foreign('rota_id')->references('id')->on('rotas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudantes');
    }
};
