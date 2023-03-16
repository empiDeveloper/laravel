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
            $table->id();
            $table->integer('state');
            $table->unsignedBigInteger('type_id');
            $table->string('name', 50);
            $table->string('email', 255);
            $table->string('phone', 20);
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('citie_id')->nullable();
            $table->string('password');
            $table->foreign('type_id')->references('id')->on('users_types');
            $table->foreign('citie_id')->references('id')->on('cities');
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
        Schema::dropIfExists('users');
    }
}
