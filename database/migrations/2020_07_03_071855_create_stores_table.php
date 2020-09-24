<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('siren',255)->unique()->nullable();
            $table->string('address',255)->nullable();
            $table->string('address_complement',255)->nullable();
            $table->integer('zip')->nullable();
            $table->string('city',255)->nullable();
            $table->boolean('main');
            $table->string('stripe_customer_id', 255)->nullable();
            $table->boolean('active')->default(true);
            $table->string('slug',255);
            $table->string('tva', 50)->nullable();
            $table->unsignedInteger('store_type_id');
            $table->timestamps();

            $table->foreign('store_type_id')->references('id')
                ->on('store_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
