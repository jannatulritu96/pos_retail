<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outlet');
            $table->foreign('outlet')->references('id')->on('outlets');
            $table->unsignedBigInteger('supplier');
            $table->foreign('supplier')->references('id')->on('suppliers');
            $table->string('receive_no');
            $table->string('receive_date');
            $table->string('challan_no');
            $table->string('challan_date');
            $table->string('challan_doc')->nullable();
            $table->string('receive_note');
            $table->string('total_qty');
            $table->string('total_amount');
            $table->string('tax');
            $table->string('discount_amount')->nullable();
            $table->string('payable_amount');
            $table->string('paid_amount');
            $table->string('due_amount');
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
        Schema::dropIfExists('stock_ins');
    }
}
