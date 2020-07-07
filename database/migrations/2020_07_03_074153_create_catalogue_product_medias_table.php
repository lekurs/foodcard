<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_product_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path', 255)->unique();
            $table->integer('position')->unsigned();
            $table->timestamps();
            $table->unsignedInteger('product_id');

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
        Schema::dropIfExists('catalogue_product_medias');
    }
}
