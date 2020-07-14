<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_products', function (Blueprint $table) {
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('catalogue_product_id');

            $table->foreign('store_id')->references('id')
                ->on('stores');
            $table->foreign('catalogue_product_id')->references('id')
                ->on('catalogue_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores_products');
    }
}
