<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueCategoryLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_category_locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->text('icon');
            $table->string('slug');
            $table->text('color');
            $table->unsignedInteger('locale_id');
            $table->unsignedInteger('catalogue_category_id');
            $table->timestamps();

//            $table->primary(['locale_id', 'catalogue_category_id'], 'category_id');

            $table->foreign('locale_id')->references('id')
                ->on('locales')->onDelete('cascade');
            $table->foreign('catalogue_category_id', 'catalogue_id')->references('id')
                ->on('catalogue_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue_category_locales');
    }
}
