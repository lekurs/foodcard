<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle', 255);
            $table->text('description');
            $table->string('allergy', 255)->nullable();
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
        Schema::dropIfExists('product_locales');
    }
}
