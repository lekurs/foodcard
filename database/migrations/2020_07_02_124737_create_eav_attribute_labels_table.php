<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEavAttributeLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eav_attribute_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 255);
            $table->integer('eav_attribute_language_id')->unsigned();
            $table->integer('eav_attribute_id')->unsigned();

            $table->foreign('eav_attribute_language_id')->references('id')
                ->on('eav_attribute_languages');

            $table->foreign('eav_attribute_id')->references('id')
                ->on('eav_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eav_attribute_labels');
    }
}
