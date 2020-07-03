<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('path', 255);
            $table->unsignedInteger('store_id');
            $table->timestamps();

            $table->foreign('store_id')->references('id')
                ->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_medias');
    }
}
