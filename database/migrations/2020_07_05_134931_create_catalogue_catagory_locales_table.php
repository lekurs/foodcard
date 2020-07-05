<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueCatagoryLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_catagory_locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('locale_id');
            $table->timestamps();

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
        Schema::dropIfExists('catalogue_catagory_locales');
    }
}
