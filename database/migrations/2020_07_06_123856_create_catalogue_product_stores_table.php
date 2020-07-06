<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_product_stores', function (Blueprint $table) {
            $table->string('field', 255);
            $table->text('value');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->primary(['field', 'store_id', 'product_id']);
            $table->foreign('store_id')->references('id')
                ->on('stores');
            $table->foreign('product_id')->references('id')
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
        Schema::dropIfExists('catalogue_product_stores');
    }
}
