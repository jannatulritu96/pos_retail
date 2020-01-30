<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->string('outlet');
            $table->unsignedBigInteger('outlet');
            $table->foreign('outlet')->references('id')->on('outlets');
            $table->string('file');
            $table->string('expense_no');
            $table->string('expense_date');
            $table->string('note');
//            $table->string('exp_cat');
            $table->unsignedBigInteger('exp_cat');
            $table->foreign('exp_cat')->references('id')->on('expense_categories');
            $table->string('amount');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('expenses');
    }
}
