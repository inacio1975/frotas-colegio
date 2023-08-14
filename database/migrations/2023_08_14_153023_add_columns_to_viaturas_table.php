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
        Schema::table('viaturas', function (Blueprint $table) {
            $table->decimal('valor_pagar_mes', $total=16)->default(0.0);
            $table->decimal('penalizacao_dia', $total=16)->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('viaturas', function (Blueprint $table) {
            $table->dropColumn('valor_pagar_mes');
            $table->dropColumn('penalizacao_dia');
        });
    }
};
