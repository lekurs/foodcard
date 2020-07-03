<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_products', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('catalogue_product_type');
            $table->timestamps();

            $table->foreign('store_id')->references('id')
                ->on('stores');
            $table->foreign('catalogue_product_type')->references('id')
                ->on('catalogue_product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue_products');
    }
}
