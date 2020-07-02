<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('lastname', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 10)->unique();
            $table->string('business-role', 255);
            $table->string('slug', 255)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_shops');
    }
}
