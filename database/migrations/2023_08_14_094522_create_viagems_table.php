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
        Schema::create('viagems', function (Blueprint $table) {
            $table->id();
            $table->date('data_viagem');
            $table->unsignedBigInteger('rota_id');
            $table->unsignedBigInteger('viatura_id');
            $table->timestamps();

            $table->foreign('rota_id')->references('id')->on('rotas');
            $table->foreign('viatura_id')->references('id')->on('viaturas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viagems');
    }
};
