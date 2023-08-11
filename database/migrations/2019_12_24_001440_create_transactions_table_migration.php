<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference')->nullable();
            $table->unsignedBigInteger('estudante_id')->nullable();
            $table->unsignedBigInteger('payment_method_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('estudante_id')->references('id')->on('estudantes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
