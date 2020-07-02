<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueRecettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_recettes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalogue_type_id')->unsigned();
            $table->integer('shop_id')->unsigned();
            $table->timestamps();

            $table->foreign('shop_id')->references('id')
                ->on('shops');

            $table->foreign('catalogue_type_id')->references('id')
                ->on('catalogue_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue_recettes');
    }
}
