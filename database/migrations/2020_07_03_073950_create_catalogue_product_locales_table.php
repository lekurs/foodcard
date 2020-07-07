<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_product_locales', function (Blueprint $table) {
            $table->string('libelle', 255)->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('locale_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->primary(['product_id', 'locale_id']);

            $table->foreign('product_id')->references('id')
                ->on('catalogue_products');

            $table->foreign('locale_id')->references('id')
                ->on('locales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue_product_locales');
    }
}
