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
            $table->increments('id');
            $table->string('field', 255);
            $table->text('value');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->foreign('store_id')->references('id')
                ->on('stores')->onDelete('cascade');
            $table->foreign('product_id')->references('id')
                ->on('catalogue_products')->onDelete('cascade');
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
