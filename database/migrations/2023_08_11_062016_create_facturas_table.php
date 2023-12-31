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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 10, 2);
            $table->date('data_emissao');
            $table->date('data_vencimento');
            $table->enum('status_pagamento', ['Pendente', 'Pago'])->default('Pendente');
            $table->unsignedBigInteger('estudante_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('estudante_id')->references('id')->on('estudantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
