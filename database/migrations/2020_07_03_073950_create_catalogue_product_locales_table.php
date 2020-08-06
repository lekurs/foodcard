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
            $table->increments('id');
            $table->string('libelle', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('homemade')->default(false);
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('locale_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')
                ->on('catalogue_products')->onDelete('cascade');

            $table->foreign('locale_id')->references('id')
                ->on('locales')->onDelete('cascade');
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
