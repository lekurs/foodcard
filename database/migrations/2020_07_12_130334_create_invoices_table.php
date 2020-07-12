<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 255);
            $table->float('price');
            $table->timestamp('payment_date');
            $table->timestamps();

            $table->unsignedInteger('store_id');
            $table->unsignedInteger('method_payment_id');

            $table->foreign('store_id')->references('id')
                ->on('stores');
            $table->foreign('method_payment_id')->references('id')
                ->on('method_payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
