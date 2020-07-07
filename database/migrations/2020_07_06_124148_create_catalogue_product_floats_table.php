<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductFloatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_product_floats', function (Blueprint $table) {
            $table->double('price')->nullable();
            $table->double('special_price')->nullable();
            $table->double('buying_price')->nullable();
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->primary(['product_id']);
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
        Schema::dropIfExists('catalogue_product_floats');
    }
}
