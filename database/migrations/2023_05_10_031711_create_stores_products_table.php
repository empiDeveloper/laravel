<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('state')->default('1')->comment('1: Activo - 0: Inactivo');
            $table->unsignedBigInteger('idStore');
            $table->unsignedBigInteger('idProduct');
            $table->foreign('idStore')->references('id')->on('stores');
            $table->foreign('idProduct')->references('id')->on('products');
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
        Schema::dropIfExists('stores_products');
    }
}
