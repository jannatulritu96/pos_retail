<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('receive_id');
            $table->foreign('receive_id')->references('id')->on('stock_ins');
            $table->string('receive_due');
            $table->unsignedBigInteger('payment_method');
            $table->foreign('payment_method')->references('id')->on('payments');
            $table->string('payment_details');
            $table->string('payment_date');
            $table->string('paid_amount');
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
        Schema::dropIfExists('supplier_payments');
    }
}
