<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('siren',255)->nullable();
            $table->string('address',255)->nullable();
            $table->integer('zip')->nullable();
            $table->string('city',255)->nullable();
            $table->string('type',255);
            $table->boolean('active');
            $table->string('slug',255)->unique();
            $table->integer('contact_shop_id')->unsigned();
            $table->timestamps();

            $table->foreign('contact_shop_id')->references('id')
                ->on('contact_shops');
        });

        DB::statement('ALTER TABLE shops CHANGE COLUMN zip zip INT(5) UNSIGNED ZEROFILL NULL ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
