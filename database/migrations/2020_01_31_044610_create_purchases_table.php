<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outlet');
            $table->foreign('outlet')->references('id')->on('outlets');
            $table->unsignedBigInteger('supplier');
            $table->foreign('supplier')->references('id')->on('suppliers');
            $table->string('purchases_no');
            $table->string('purchases_date');
            $table->string('note');
            $table->unsignedBigInteger('product');
            $table->foreign('product')->references('id')->on('products');
            $table->string('quantity');
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
        Schema::dropIfExists('purchases');
    }
}
