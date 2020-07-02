<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEavAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eav_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 255);
            $table->integer('eav_attribute_id')->unsigned();
            $table->integer('eav_attribute_language_id')->unsigned();

            $table->foreign('eav_attribute_id')->references('id')
                ->on('eav_attributes');
            $table->foreign('eav_attribute_language_id')->references('id')
                ->on('eav_attribute_languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eav_attribute_values');
    }
}
