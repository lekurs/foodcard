<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname', 255);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 10);
            $table->string('slug', 255);
            $table->integer('user_fonction_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->integer('user_role_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_fonction_id')->references('id')
                ->on('user_fonctions');
            $table->foreign('store_id')->references('id')
                ->on('stores');
            $table->foreign('user_role_id')->references('id')
                ->on('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
