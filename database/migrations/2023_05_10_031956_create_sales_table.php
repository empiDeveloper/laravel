<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment("1: Catálogo - 2: Plataforma Web - 3: WhatsApp");
            $table->unsignedBigInteger('idStoreProduct');
            $table->integer('price')->comment('Precio en el cual se vendío el producto');
            $table->date('date')->comment('Fecha en la cual se vendío el producto');
            $table->unsignedBigInteger('idUser')->comment('Usuario vendedor del producto');
            $table->foreign('idStoreProduct')->references('id')->on('stores_products');
            $table->foreign('idUser')->references('id')->on('users');
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
        Schema::dropIfExists('sales');
    }
}
